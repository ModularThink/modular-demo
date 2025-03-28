import js from '@eslint/js'
import vue from 'eslint-plugin-vue'
import vueParser from 'vue-eslint-parser'
import prettierConfig from 'eslint-config-prettier'
import globals from 'globals'

export default [
    // Base ESLint recommended rules
    js.configs.recommended,

    // Prettier configuration to disable conflicting rules
    {
        rules: {
            ...prettierConfig.rules,
            'unicode-bom': 'off'
        }
    },

    // Vue plugin configuration
    {
        files: ['**/*.vue'],
        languageOptions: {
            parser: vueParser,
            parserOptions: {
                ecmaVersion: 'latest',
                sourceType: 'module'
            }
        },
        plugins: {
            vue
        },
        rules: {
            // Combine base and recommended Vue rules
            ...vue.configs.base.rules,
            ...vue.configs['vue3-recommended'].rules,

            '@stylistic/js/indent': 'off',
            '@stylistic/js/quotes': 'off',

            // Disable specific Vue rules
            'vue/no-v-html': 'off',
            'vue/comment-directive': 'off'

            // You can add other Vue-specific rules here
        }
    },

    // General JavaScript rules (for .js and .vue files)
    {
        files: ['**/*.{js,vue}'],
        rules: {
            // Disable general ESLint rules
            // 'no-undef': 'off'
        }
    },

    // Custom rules (if any)
    {
        languageOptions: {
            globals: {
                ...globals.browser,
                route: 'readonly',
                grecaptcha: 'readonly'
            }
        },
        rules: {
            // Add your custom rules here
        }
    },

    // Ignore patterns
    {
        ignores: ['node_modules/*', 'vendor/*', 'public/*']
    }
]
