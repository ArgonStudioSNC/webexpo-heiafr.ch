/*
|-------------------------------------------------------------------------------
| i18n/index.js
|-------------------------------------------------------------------------------
| Localization
*/

import { createI18n } from 'vue-i18n'

export default createI18n({
    locale: window.locale || window.default_locale || 'fr-CH', // set locale
    fallbackLocale: window.fallback_locale || 'fr-CH', // set fallback locale
    messages: window.messages,
});
