const algolia_brands_index = fdc_algolia_index.services;
const algolia_keywords_index = fdc_algolia_index.keywords;

const urlParams = new URLSearchParams(window.location.search);
const kwparam = urlParams.get('keyword') || false;
let firstLoad = true;

const search = instantsearch({
  indexName: algolia_brands_index,
  searchClient: algoliasearch('2NJZ5IVNHJ', '84972973d7b9450816ff2660ac900721'),
  searchFunction(helper) {
    const page = helper.getPage();
    if (firstLoad && kwparam) {
      helper.setQuery(kwparam);
      helper.search();
    } else {
      helper.search();
    }
    firstLoad = false;
  }
});


function sortTypes(a, b) {
  var ordering = {}, // map for efficient lookup of sortIndex
      sortOrder = ['Eat','Work','Play'];
  for (var i=0; i<sortOrder.length; i++)
      ordering[sortOrder[i]] = i;

  return (ordering[a.name] - ordering[b.name]) || a.name.localeCompare(b.name);
}


// const search = instantsearch({
//   indexName: algolia_brands_index,
//   searchClient: algoliasearch('2NJZ5IVNHJ', '84972973d7b9450816ff2660ac900721'),
//   searchFunction(helper) {
//     if (kwparam) {
//       const page = helper.getPage(); // Retrieve the current page
//       helper.setQuery(kwparam).setPage(page);
//     }
//     helper.search();
//   }
// });

const SelectedCategory = window.location.hash ? [decodeURIComponent(window.location.hash.substring(1))] : [];

// const insightsMiddleware = instantsearch.middlewares.createInsightsMiddleware({
//   insightsClient: window.aa,
// });

// search.use(insightsMiddleware);

// const userToken = 'WP_USER';
// window.aa('setUserToken', userToken);

search.addWidgets([

  instantsearch.widgets.searchBox({
    container: '#searchbox',
    placeholder: 'Search Brands by Keyword',
  }),


  // instantsearch.widgets.poweredBy({
  //   container: '#powered-by',
  // }),


  instantsearch.widgets.clearRefinements({
    container: '#clear-refinements',
    templates: {
      resetLabel: 'Clear Filters',
    },
    cssClasses: {
      button: [
        'bg-c-purple text-white px-8 py-3 block uppercase w-full',
      ],
    },
  }),




  instantsearch.widgets.refinementList({
    container: '#categories-list',
    attribute: 'categories',
    sortBy: ['name:asc'],
    limit: 50,
    // transformItems: function(items) {
    //   console.log(items);
    //   return items.map(function(item) {
    //     // do something with the item, change the label or `highlighted`
    //     return item;
    //   });
    //   // if you want to sort them differently after, you can do `.sort`
    //   // if you don't want specific items, you can `.filter` them out
    // },
    templates: {
      item: `
      <li data-refine-value="{{value}}" class="ais-RefinementList-label">
        <input type="checkbox" value="{{value}}" class="ais-RefinementList-checkbox" {{#isRefined}}checked{{/isRefined}} />
        <a href="{{url}}">{{label}} <span class="ais-RefinementList-count">({{count}})</span></a>
      </li>
    `,
    },
  }),

  
  instantsearch.widgets.configure({
    disjunctiveFacetsRefinements: {
      categories: SelectedCategory,
    },
  }),

  instantsearch.widgets.refinementList({
    container: '#types-list',
    attribute: 'types',
    sortBy: sortTypes,
    templates: {
      item: `
      <li data-refine-value="{{value}}" class="ais-RefinementList-label">
        <input type="checkbox" value="{{value}}" class="ais-RefinementList-checkbox" {{#isRefined}}checked{{/isRefined}} />
        <a href="{{url}}">{{label}} <span class="ais-RefinementList-count">({{count}})</span></a>
      </li>
    `,
    },
  }),


  instantsearch.widgets.refinementList({
    container: '#scores-list',
    attribute: 'overall_score',
    templates: {
      item: `
      <li data-refine-value="{{value}}" class="ais-RefinementList-label">
        <input type="checkbox" value="{{value}}" class="ais-RefinementList-checkbox" {{#isRefined}}checked{{/isRefined}} />
        <a href="{{url}}">{{label}} <span class="ais-RefinementList-count">({{count}})</span></a>
      </li>
    `,
    },
  }),
  // <a href="{{url}}">{{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}</a>
  instantsearch.widgets.hits  ({
    container: '#brandListings',
    escapeHTML: false,
    cssClasses: {
      list: ['hits-list'],
    },
    templates: {
      empty: '<div class="pt-5"><strong>No results for <q>{{ query }}</q></strong></div>',
      item: `
          <article class="listing">
              <div class="top py-5">
                <p class="text-center font-semibold text-base lg:text-xl text-gray-600 hit-title">{{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}</p>
              </div>
              <div class="inner px-4 pb-8 flex justify-center">
                <div>
                  {{#helpers.highlight}}{ "attribute": "excerpt" }{{/helpers.highlight}}
                  {{#categorydata}}<span class="cat-icon"><img class="mx-auto w-20 md:w-auto" src="{{icon}}" alt="category-icon"></span>{{/categorydata}}
                </div>
              </div>
              <div class="bottom score-{{overall_score}}">
                <span class="flex items-center">
                  <img src="/app/themes/fdc/assets/img/icon-{{overall_score}}.png" align="left" alt="icon" />
                  <span class="text-white uppercase text-sm ml-2">{{overall_score}}</span>
                </span>
              </div>
          </article>
      `,
    },
  }),

  instantsearch.widgets.pagination({
    container: '#pagination',
  }),

]);

search.start();
