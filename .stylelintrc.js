module.exports = {
  'extends': 'stylelint-config-standard',
  'rules': {
    'no-empty-source': null,
    'string-quotes': 'double',
    'at-rule-no-unknown': [
      true,
      {
        'ignoreAtRules': [
          'extend',
          'at-root',
          'debug',
          'warn',
          'error',
          'if',
          'else',
          'for',
          'each',
          'while',
          'mixin',
          'include',
          'content',
          'return',
          'function',
          'tailwind',
          'apply',
          'responsive',
          'variants',
          'screen',
        ],
      },
    ],
      "indentation": 4,
      "no-eol-whitespace": [true, {
          ignore: ["empty-lines"]
      }],
      "declaration-empty-line-before": ["never"],
      "no-descending-specificity": null,
      "number-leading-zero": "never"
  },
};
