<?php

class sevenSMS extends waSMSAdapter
{
    private $url = 'https://gateway.seven.io/api/sms';

    /**
     * @return array
     */
    public function getControls()
    {
        return array(
            'api_key' => array(
                'description' => 'Your <a href=\'https://help.seven.io/en/articles/9582186-where-do-i-find-my-api-key\' target=\'_blank\'>API key</a> from seven.io',
                'title'       => 'API Key',
            ),
            'flash' => array(
                'control_type' => waHtmlControl::CHECKBOX,
                'description' => 'Send as <a href=\'https://help.seven.io/en/articles/9582226-flash-sms\' target=\'_blank\'>Flash SMS</a>?',
                'title'       => 'Flash SMS',
            ),
            'performance_tracking' => array(
                'control_type' => waHtmlControl::CHECKBOX,
                'description' => 'Use <a href=\'https://help.seven.io/en/articles/9582182-performance-tracking\' target=\'_blank\'>Performance Tracking</a>?',
                'title'       => 'Performance Tracking',
            ),
        );
    }

    /**
     * @param string $to
     * @param string $text
     * @param string $from
     * @return mixed
     */
    public function send($to, $text, $from = null)
    {
        $post = array(
            'p' => $this->getOption('api_key'),
            'flash' => (int)$this->getOption('flash'),
            'from' => $from,
            'to'     => $to,
            'performance_tracking' => (int)$this->getOption('performance_tracking'),
            'text'   => $text
        );

        $net = new waNet();
        try {
            $result = (int)$net->query($this->url, $post, waNet::METHOD_POST);
            $this->log($to, $text, $result);

            $error = null;
            switch ($result) {
                case 100:
                    break;
                case 101:
                    $error = 'Sending to at least one recipient failed.';
                    break;
                case 201:
                    $error = 'Sender invalid. A maximum of 11 alphanumeric or 16 numeric characters are permitted.';
                    break;
                case 202:
                    $error = 'The recipient number is invalid.';
                    break;
                case 301:
                    $error = 'Parameter to not set.';
                    break;
                case 305:
                    $error = 'Parameter text is invalid.';
                    break;
                case 401:
                    $error = 'Parameter text is too long.';
                    break;
                case 402:
                    $error = 'This SMS has already been sent within the last 180 seconds. You can deactivate this block in your account settings.';
                    break;
                case 403:
                    $error = 'Maximum limit per day reached for this recipient number.';
                    break;
                case 500:
                    $error = 'Account has too little credit to send this SMS.';
                    break;
                case 600:
                    $error = 'An error has occurred during sending.';
                    break;
                case 802:
                    $error = 'Provided label is invalid.';
                    break;
                case 900:
                    $error = 'Authentication has failed. Please check the API key used in Authentication.';
                    break;
                case 901:
                    $error = 'Verification of the signing hash failed.';
                    break;
                case 902:
                    $error = 'The API key does not have access rights to this endpoint.';
                    break;
                case 903:
                    $error = 'The IP from which the request was executed is not included in the List of permitted IP addresses.';
                    break;
                default:
                    $error = sprintf('Unknown return code %s', $result);
            }

            if ($error) {
                $this->log($to, $text, sprintf('%d: %s', $result, $error));
                $result = false;
            }
        } catch (waException $ex) {
            $result = $ex->getMessage();
            $this->log($to, $text, $result);
            $result = false;
        }

        return $result;
    }
}
