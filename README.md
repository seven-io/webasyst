<p align="center">
  <img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" alt="seven logo" />
</p>

<h1 align="center">seven SMS for Webasyst</h1>

<p align="center">
  SMS adapter for <a href="https://www.webasyst.com/">Webasyst</a> - plugs seven into the Webasyst SMS subsystem.
</p>

<p align="center">
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-teal.svg" alt="MIT License" /></a>
  <img src="https://img.shields.io/badge/Webasyst-plugin-blue" alt="Webasyst plugin" />
  <img src="https://img.shields.io/badge/PHP-7.4%2B-purple" alt="PHP 7.4+" />
</p>

---

## Features

- **SMS Adapter** - Adds seven as a selectable provider in **Settings > SMS**
- **Drop-in Install** - Standard Webasyst SMS plugin layout

## Prerequisites

- A [Webasyst](https://www.webasyst.com/) installation
- A [seven account](https://www.seven.io/) with API key ([How to get your API key](https://help.seven.io/en/developer/where-do-i-find-my-api-key))

## Installation

```bash
cd <webasyst-root>/wa-plugins/sms
git clone https://github.com/seven-io/webasyst seven
```

## Configuration

1. Open the Webasyst admin and go to **Settings > SMS**.
2. Find the *seven.io* provider, paste your seven API key and click **Save**.

## Testing

Open **SMS > SMS templates**, click **Check sending** and submit the form to verify dispatch.

## Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/) or [open an issue](https://github.com/seven-io/webasyst/issues).

## License

[MIT](LICENSE)
