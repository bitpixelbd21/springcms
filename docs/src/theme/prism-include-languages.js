import siteConfig from '@generated/docusaurus.config';
export default function prismIncludeLanguages(PrismObject) {
  const {
    themeConfig: {prism},
  } = siteConfig;
  const {additionalLanguages} = prism;
  // Prism components work on the Prism instance on the window, while prism-
  // react-renderer uses its own Prism instance. We temporarily mount the
  // instance onto window, import components to enhance it, then remove it to
  // avoid polluting global namespace.
  // You can mutate PrismObject: registering plugins, deleting languages... As
  // long as you don't re-assign it
  const PrismBefore = globalThis.Prism;
  globalThis.Prism = PrismObject;
  additionalLanguages.forEach((lang) => {
    if (lang === 'php') {
      // eslint-disable-next-line global-require
      require('prismjs/components/prism-markup-templating.js');
    }
    // eslint-disable-next-line global-require, import/no-dynamic-require
    require(`prismjs/components/prism-${lang}`);
  });

  //end minimal support for blade syntax
  globalThis.Prism.languages.blade = Prism.languages.extend('markup', {
    'blade-directive': {
      pattern: /@[\w]+/,
      alias: 'keyword',
    },
    'blade-php': {
      pattern: /(\{\{|\{\%)([\s\S]+?)(\}\}|\%\})/,
      lookbehind: true,
      inside: {
        'php': {
          pattern: /[\s\S]+/,
          inside: Prism.languages.php,
        },
      },
    },
  });

  // Clean up and eventually restore former globalThis.Prism object (if any)
  delete globalThis.Prism;
  if (typeof PrismBefore !== 'undefined') {
    globalThis.Prism = PrismObject;
  }
}
