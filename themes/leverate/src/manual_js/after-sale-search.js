
// ===================================
// ======= Configuration =============
// ===================================

 var templateURL = php_params.templateUrl;

// ==== Fuse Config
var options = {
    shouldSort: true,
    threshold: 0.2,
    location: 0,
    distance: 200,
    maxPatternLength: 32,
    minMatchCharLength: 1,
    keys: [
        "title"
    ]
};

// ==== key config
var key = 'asdffd99js3nfd313fds223finh4j9f20';

// ==== Global Variables
var fuseObject;
var searchStateReady = false;
var showAllFlag = false;

// ====================================
// ====== Running Code ================
// ====================================
jQuery( document ).ready(function() {
    var termInput = jQuery("#term");

    console.log(termInput);
    var term;

    var queryParameters = {};
    var queryString = location.search.substring(1);
    if (!queryString) {
        queryString = 'term=';
        showAllFlag = true;
    }
    var re = /([^&=]+)=([^&]*)/g, m;

    while (m = re.exec(queryString)) {
        queryParameters[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
    }
    if (term) {
        termInput.val(term.split('+').join(' '));
    }
// ====== Ajax Requests ===============
    var requestProducts = jQuery.ajax({
        url: "/wp-json/starplast/v1/products/",
        method: "POST",
        data: { key : key },
        dataType : 'json'
    });
    requestProducts.done(function(list) {
        console.log( list);
        // loadingElem.hide();
        searchStateReady = true;
        // console.log('Doctor List size: ' + list.length);
        fuseObject = new Fuse(list, options); // "list" is the item array
        var searchResults = getSearchResults(queryParameters['term']);
        rebuildTable(searchResults, queryParameters['area']);
    });
    requestProducts.fail(function( jqXHR, textStatus ) {
        console.log('failed to load doctors');
    });
    // refresh search when user change term input
    termInput.keyup(function () {
        if (searchStateReady) {
            showAllFlag = false;
            if (!this.value) {
                showAllFlag = true;
            }
            var searchResults = getSearchResults(this.value);
            queryParameters['term'] = this.value;
            console.log(searchResults);
            rebuildTable(searchResults, queryParameters['area']);
        }
    });
});
// ====================================
// ====== Helper Functions ============
// ====================================
/**
 * Returns fuse search results based on the term.
 * @param term
 */
function getSearchResults(term) {
    if(!term) {
        showAllFlag = true;
        console.log('hide');
        $('#docSearchResultsTable').hide();
        $('.clear').hide();
        $('#proceed').hide();
        $('.startButtonsContainer').hide();
    }
    else {
        console.log ('test else');
        $('#docSearchResultsTable').show();
        $('.clear').show();
        $('#proceed').show();
        $('.startButtonsContainer').show();
    }

    fuseObject.options.threshold = 0.2;
    console.log('term: ' + term);

    console.log('num of results: ' + fuseObject.search(term).length);
    return fuseObject.search(term);

    if(term) {
        showAllFlag = true;
        console.log('show');

    }
}

/**
 * Generate the html search results based on the search results.
 * Also it filters out results that are not part of the current area.
 * @param data - the search results data array.
 * @param area - the Area we should display results for, if area=all, doesn't filter out anything.
 */
function rebuildTable(data, area) {
    var tableBodyElem = jQuery('#tableBody');
    var noResultsElem = jQuery('#NoSearchResults');

    // clear the table
    tableBodyElem.empty();

    // if no data for the table
    if(data.length === 0) {
        // no data
        tableBodyElem.hide();
        noResultsElem.show();
    } else {
        // yes data
        tableBodyElem.show();
        noResultsElem.hide();
    }

    jQuery.each(data, function(index, item) {
            var tableRow;
            //filter out results that are not in the area.
            if (area && area !== 'all' && area !== item.area) {
                return true;
            }
            item.additionalClasses = '';
            item.imgURL = item.img;

                tableRow =
                '<ul>' +

                    '<li class="name-td">'   +
                    '<div class="checkpost">'   +
                    '<div id="productlink" class="productlink" target="_blank" href="' + item.url + '">' + item.img +
                    '<div class="myTitleContainer"> <div id="myname" class="name" >' + item.title + '</div>' +
                    '<div id="mysku" class="sku" >' + item.sku + '</div></div></div></div>' +
                    '</li>'+

                '</ul>';

            tableBodyElem.append(tableRow)



        $(document).on('click', '.checkpost', function(){
            $('.selecteeee').removeClass('selecteeee');
            $(this).addClass('selecteeee');
            $(this).addClass('thisline');
            $(this).addClass('selecteeee');
            var value;
            var value = $(".thisline #productlink").attr("href");

            console.log('Send data to productlink ' + value);
            document.getElementById('proceedproduct').setAttribute('href', value);
            $("#proceedproduct").attr("href", value);

            var myname;
            myname = $('.thisline .name')[0];
            myname = myname.innerHTML;
            console.log('Data' + myname);

            var mysku;

            mysku = $('.thisline .sku')[0];
            mysku = mysku.innerHTML;
            console.log('Data' + mysku);

            $("#productname").val(myname);
            $("#productsku").val(mysku);
            $(this).removeClass('thisline');

        }) ;

        $('#proceedform').click(function() {

            console.log('Need to open form');
            $('.checkoutOrder .personalInformation .inputsArea').show();

        });
    });
}




function predicateBy(prop){
    return function(a,b){
        if( a[prop] > b[prop]){
            return 1;
        }else if( a[prop] < b[prop] ){
            return -1;
        }
        return 0;
    }
}


function sortByCity() {
    var searchResults = getSearchResults(queryParameters['term']);
    queryParameters['area'] = this.value;
    searchAreaTitle.text(areaList[queryParameters['area']]);
    rebuildTable(searchResults, this.value);
}


function shuffleArray(sourceArray) {

}



//location.search = jQuery.param(queryParameters); // Causes page to reload
