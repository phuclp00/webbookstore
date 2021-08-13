import { autocomplete } from '@algolia/autocomplete-js';
import { createQuerySuggestionsPlugin } from '@algolia/autocomplete-plugin-query-suggestions';
import algoliasearch from 'algoliasearch';

import '@algolia/autocomplete-theme-classic';

const appId = 'K177MITG7W';
const apiKey = '7ffdbc248bd1211b1bd1696f1d89cfa6';
const searchClient = algoliasearch(appId, apiKey);

const querySuggestionsPlugin = createQuerySuggestionsPlugin({
  searchClient,
  indexName: 'book',
  getSearchParams() {
    return {
      hitsPerPage: 10,
    };
  },
});

autocomplete({
  container: '#autocomplete',
  placeholder: 'Search',
  openOnFocus: true,
  plugins: [querySuggestionsPlugin],
});
