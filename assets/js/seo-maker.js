// if(typeof seo_engine !== 'undefined'){


$('.seo-maker').css({
    'background-color': 'rgb(231,231,255)',
    'padding': '15px',
    'margin-bottom': '15px'
});

var keywords = $('#keywords');

if (typeof seo_engine === 'undefined' || seo_engine === null) {
    // do nothing
} else {



    const KEYWORDS_LIMIT = atob(atob(seo_engine['code']));

    keywords.on('keyup', function () {
        var keyword = keywords.val();
        var all_keywords = keyword.split(',');
        if (all_keywords.length <= KEYWORDS_LIMIT) {
            // console.log(all_keywords.length);
        } else {
            var force_keywords = all_keywords[0];
            for (let index = 1; index < KEYWORDS_LIMIT; index++) {
                const element = all_keywords[index];
                force_keywords += ',' + all_keywords[1]
            }
            keywords.val(force_keywords);
            keywords.blur();
        }
    });

}

var seo_meta_property_add_btn = $('#seo-meta-property-add-btn');

function new_seo_meta(type = 'name') {

    var meta_field_unique_id = Date.now();

    var content = '<div class="row" id="meta-prop-' + meta_field_unique_id + '">';
    content += '<div class="remove" onclick="remove_meta_prop(' + meta_field_unique_id + ')">&times;</div>';


    switch (type) {
        case 'name':
            content += '<div class="mb-3 col-md-6">';
            content += '<label class="form-label">Name Type</label>';
            content += '<input type="text" class="form-control" placeholder="Name Type" name="name-' + meta_field_unique_id + '">';
            content += '</div>';
            content += '<div class="mb-3 col-md-6">';
            content += '<label class="form-label" for="meta-description">Name Value</label>';
            content += '<input type="text" class="form-control" placeholder="Name Value" name="name-content-' + meta_field_unique_id + '">';
            content += '</div>';
            break;

        case 'property':
            content += '<div class="mb-3 col-md-6">';
            content += '<label class="form-label" for="meta-description">Property Type</label>';
            content += '<input type="text" class="form-control" placeholder="Property Type" name="property-' + meta_field_unique_id + '">';
            content += '</div>';
            content += '<div class="mb-3 col-md-6">';
            content += '<label class="form-label" for="meta-description">Property Value</label>';
            content += '<input type="text" class="form-control" placeholder="Property Value" name="property-content-' + meta_field_unique_id + '">';
            content += '</div>';
            break;

        default:
            break;
    }

    content += '</div>';

    seo_meta_property_add_btn.before(content);

}

function remove_meta_prop(meta_prop_id) {
    $('#meta-prop-' + meta_prop_id).remove();
}
