<p align="center">
    <a href="https://monsieurbiz.com" target="_blank">
        <img src="https://monsieurbiz.com/logo.png" width="250px" alt="Monsieur Biz logo" />
    </a>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <a href="https://monsieurbiz.com/agence-web-experte-sylius" target="_blank">
        <img src="https://demo.sylius.com/assets/shop/img/logo.png" width="200px" alt="Sylius logo" />
    </a>
    <br/>
    <img src="https://monsieurbiz.com/assets/images/sylius_badge_extension-artisan.png" width="100" alt="Monsieur Biz is a Sylius Extension Artisan partner">
</p>

<h1 align="center">Advanced Option</h1>

[![Advanced Option Plugin license](https://img.shields.io/github/license/monsieurbiz/SyliusAdvancedOptionPlugin?public)](https://github.com/monsieurbiz/SyliusAdvancedOptionPlugin/blob/master/LICENSE.txt)
[![Tests Status](https://img.shields.io/github/workflow/status/monsieurbiz/SyliusAdvancedOptionPlugin/Tests?logo=github)](https://github.com/monsieurbiz/SyliusAdvancedOptionPlugin/actions?query=workflow%3ATests)
[![Security Status](https://img.shields.io/github/workflow/status/monsieurbiz/SyliusAdvancedOptionPlugin/Security?label=security&logo=github)](https://github.com/monsieurbiz/SyliusAdvancedOptionPlugin/actions?query=workflow%3ASecurity)

This plugins improves the Options in Sylius. It adds the possibility to select a renderer and to add images to the option's values.

## Installation

⚙️ To Be Defined.

### Migrations

Migrations are taken care of by Doctrine 3.

You should just run them: 

```php
bin/console doctrine:migrations:migrate
```

### Template override

If you have already replaced the `templates/bundles/SyliusShopBundle/Product/Show/_options.html.twig` template in your theme, modify the content to use the twig functions:

- monsieurbiz_advancedoption_has_renderer
- monsieurbiz_advancedoption_form_row

Read the default override to get inspiration from its content: [_options.html.twig](/src/Resources/templates/bundles/SyliusShopBundle/Product/Show/_options.html.twig).

## Sponsors

- EasyMonneret

## Contributing

You can open an issue or a Pull Request if you want! 😘  
Thank you!
