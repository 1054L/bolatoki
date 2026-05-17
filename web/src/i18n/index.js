import { createI18n } from 'vue-i18n';
import es from './locales/es.json';
import eu from './locales/eu.json';
import en from './locales/en.json';

const i18n = createI18n({
  legacy: false, // Use Composition API
  locale: 'es', // default locale
  fallbackLocale: 'es',
  messages: {
    es,
    eu,
    en,
  },
});

export default i18n;
