(function() {
        const algoliaClient = algoliasearch('K177MITG7W', '7ffdbc248bd1211b1bd1696f1d89cfa6');
        const searchClient = {
            search(requests) {
                if (requests.every(({
                        params
                    }) => !params.query)) {
                    return Promise.resolve({
                        results: requests.map(() => ({
                            hits: [],
                            nbHits: 0,
                            nbPages: 0,
                            page: 0,
                            processingTimeMS: 0,
                        })),
                    });
                }

                return algoliaClient.search(requests);
            },
        };
        const search = instantsearch({
            indexName: 'book',
            searchClient,
        });

        // After the `searchBox` widget
        search.addWidgets([{
                        init(opts) {
                            const helper = opts.helper;
                            const input = document.querySelector('#searchBox');
                            input.addEventListener('input', ({ currentTarget }) => {
                                helper.setQuery(currentTarget.value) // update the parameters
                                    .search(); // launch the query
                            });
                        }
                    },
                    instantsearch.widgets.hits({
                        container: '#hit',
                        templates: {
                            empty: "No results.",
                            item: `
                    <a href="#" class="hit-image">
                        <img src="../public/images/books/{{book_id}}/{{img}}" align="left" alt="{{img}}" class="img__boxsearch" />
                    </a>
                    <div class="title__boxsearch"><h2>{{#helpers.highlight}}{ "attribute": "book_name" }{{/helpers.highlight}}</h2><div>
                    <p>\${{price}}</p>
                     `,
                        },
                    }),
                    instantsearch.widgets.stats({
                            container: "#stats",
                            templates: {
                                body(hit) {
                                    return `<span role="img" aria-label="emoji">⚡️</span> <strong>${hit.nbHits}</strong> results found ${
                                    hit.query != "" ? `for <strong>"${hit.query}"</strong>` : ``
                                    } in <strong>${hit.processingTimeMS}ms</strong>`;
                                }
                     }
                    })
    ]);

    /* 
     <div id="hints" class="minicart-content-wrapper bg--white">
                <table>
                    <tr>
                        <th>
                            <h3 id="result_title"></h3>
                        </th>
                        <th><span id="result_count"></span></th>
                    </tr>
                    <tr>
                        <td id="result_hints"></td>
                    </tr>
                </table>
            </div> 
    */
    // search.addWidgets([{
    //         init(opts) {
    //             const helper = opts.helper;
    //             const input = document.querySelector('#searchBox');
    //             input.addEventListener('input', ({
    //                 currentTarget
    //             }) => {
    //                 helper.setQuery(currentTarget.value) // update the parameters
    //                     .search(); // launch the query
    //             });
    //         }
    //     },
    //     {
    //         render(options) {
    //             const results = options.results;
    //             // read the hits from the results and transform them into HTML.
    //             document.querySelector('#hits').innerHTML = results.hits
    //                 .map(
    //                     hit => `<a href="#">${instantsearch.highlight({ attribute: 'book_name', hit })}</a>`
    //                 )
    //                 .join('');
    //         },
    //     }
    // ]);
    search.start();
})();