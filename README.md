# Email Subscribe Plugin

**This README.md file should be modified to describe the features, installation, configuration, and general usage of this plugin.**

The **Mailchimp Subscribe** Plugin is for [Grav CMS](http://github.com/getgrav/grav). Mailchimp subscription functionality

## Installation

Installing the Mailchimp Subscribe plugin can be done in one of two ways. The GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

### GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install email-subscribe

This will install the Email Subscribe plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/email-subscribe`.

### Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `email-subscribe`. You can find these files on [GitHub](https://github.com/andrew-scofield/grav-plugin-email-subscribe) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/email-subscribe
	
> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) and the [Error](https://github.com/getgrav/grav-plugin-error) and [Problems](https://github.com/getgrav/grav-plugin-problems) to operate.

## Configuration

Before configuring this plugin, you should copy the `user/plugins/email-subscribe/email-subscribe.yaml` to `user/config/plugins/email-subscribe.yaml` and only edit that copy.

Here is the default configuration and an explanation of available options:

```yaml
enabled: true
```

## Usage

**Describe how to use the plugin.**

## Credits

**Did you incorporate third-party code? Want to thank somebody?**

## To Do

- [ ] Future plans, if any

