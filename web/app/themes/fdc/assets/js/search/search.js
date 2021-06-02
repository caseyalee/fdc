const algolia_brands_index = fdc_algolia_index.services;
const algolia_keywords_index = fdc_algolia_index.keywords;

const urlParams = new URLSearchParams(window.location.search);
const kwparam = urlParams.get('keyword') || false;
const typeparam = urlParams.get('type') || false;
const categoryparam = urlParams.get('category') || false;
const overallscoreparam = urlParams.get('overall_score') || false;

let firstLoad = true;

const search = instantsearch({
  indexName: algolia_brands_index,
  searchClient: algoliasearch('2NJZ5IVNHJ', '84972973d7b9450816ff2660ac900721'),
  searchFunction(helper) {
    const page = helper.getPage();
    if (firstLoad) {

      if (overallscoreparam) {
        helper.addDisjunctiveFacetRefinement('overall_score', overallscoreparam);
      }

      if (categoryparam) {
        helper.addDisjunctiveFacetRefinement('categories', categoryparam);
      }

      if (typeparam) {
        helper.addDisjunctiveFacetRefinement('types', typeparam);
      }

      if (kwparam) {
        helper.setQuery(kwparam);
      }

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


function sortScores(a, b) {
  var ordering = {}, // map for efficient lookup of sortIndex
      sortOrder = ['compatible','acceptable','incompatible'];
  for (var i=0; i<sortOrder.length; i++)
      ordering[sortOrder[i]] = i;

  return (ordering[a.name] - ordering[b.name]) || a.name.localeCompare(b.name);
}


const SelectedCategory = window.location.hash ? [decodeURIComponent(window.location.hash.substring(1))] : [];


search.addWidgets([

  instantsearch.widgets.searchBox({
    container: '#searchbox',
    placeholder: 'Search Brands by Keyword',
  }),


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
    sortBy: sortScores,
    transformItems(items) {
      return items.map(item => {
        // console.log(item.label)
        if (item.label == 'compatible') {
          item.label = 'compatible (best)'
        }
        // item._highlightResult.fakeName = {
        //   value: item._highlightResult['label'].value.toLocaleUpperCase(),
        // };
        return item;
      });
    },
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
          <article class="brand-card">
            <div class="brand-card-inner">
              <div class="front flex flex-wrap">
                <div class="top self-start w-full px-3 py-5 lg:px-5">
                  <p class="text-center font-semibold text-sm md:text-base lg:text-lg xl:text-xl text-gray-600 leading-tight hit-title">{{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}</p>
                </div>
                <div class="inner px-4 pb-8 self-center w-full flex justify-center">
                  <div class="text-center">
                      <span class="cat-icon"><img class="mx-auto w-20 md:w-auto" src="{{logo}}" alt="logo"></span>
                  </div>
                </div>
                <div class="card-bottom score-{{overall_score}} w-full self-end">
                  <span class="flex items-center">
                    <img src="/app/themes/fdc/assets/img/icon-{{overall_score}}.png" align="left" alt="icon" />
                    <span class="text-white uppercase text-sm ml-2">{{overall_score}}</span>
                  </span>
                </div>
              </div>
              <div class="back flex flex-wrap">
                <div class="top self-start w-full px-3 py-5 lg:px-5">
                  <p class="font-semibold text-sm md:text-base lg:text-lg xl:text-xl text-gray-600 leading-tight hit-title">{{#helpers.highlight}}{ "attribute": "title" }{{/helpers.highlight}}</p>
                </div>
                <div class="inner px-3 lg:px-5 pb-8 self-center w-full flex justify-center">
                  <ul class="w-full">
                    <li class="border-b border-gray-300 text-gray-600 text-xs md:text-base 2xl:text-lg leading-normal lg:leading-6 xl:leading-8 flex"><span class="w-3/4">Marketplace Score:</span> <strong class="w-1/4">{{marketplace_score}}</strong></li>
                    <li class="border-b border-gray-300 text-gray-600 text-xs md:text-base 2xl:text-lg leading-normal lg:leading-6 xl:leading-8 flex"><span class="w-3/4">Workplace Score:</span> <strong class="w-1/4">{{workplace_score}}</strong></li>
                    <li class="border-b border-gray-300 text-gray-600 text-xs md:text-base 2xl:text-lg leading-normal lg:leading-6 xl:leading-8 flex"><span class="w-3/4">Culture Score:</span> <strong class="w-1/4">{{culture_score}}</strong></li>
                  </ul>
                </div>
                <div class="card-bottom score-{{overall_score}} w-full self-end">
                  <span class="flex items-center">
                    <img src="/app/themes/fdc/assets/img/icon-{{overall_score}}.png" align="left" alt="icon" />
                    <span class="text-white uppercase text-sm ml-2">{{overall_score}}</span>
                  </span>
                </div>
              </div>
            </div>
          </article>
      `,
    },
  }),

  instantsearch.widgets.pagination({
    container: '#pagination',
  }),

  instantsearch.widgets.hitsPerPage({
    container: '#hitsperpage',
    items: [
      { label: '12', value: 12, default: true },
      { label: '24', value: 24 },
      { label: '30', value: 30 },
      { label: '60', value: 60 },
    ],
  })

]);

search.start();
