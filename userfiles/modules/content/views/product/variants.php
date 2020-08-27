<?php
$productVariantOptions = [];
$productVariantOptions[] = [
    'option_name'=>'Size',
    'option_values'=>['L','X','XL','M'],
];
$productVariantOptions[] = [
    'option_name'=>'Color',
    'option_values'=>['Green','Blue','White','Black'],
];
?>

<script>mw.lib.require('mwui_init')</script>
<style>
    .js-product-variants {
        display: none;
    }
</style>

<script>
    function addProductVariantOption(option_id = 0, option_name = '', option_values = '')
    {
        var optionHtml = '<div class="row js-product-variant-option-'+option_id+'">\n' +
            '                    <div class="col-md-4">\n' +
            '                        <div class="form-group">\n' +
            '                            <h6 class="pb-1"><strong>Option '+(option_id+1)+'</strong></h6>\n' +
            '                            <div>\n' +
            '                                <input type="text" name="product_variant_option['+option_id+'][name]" value="'+option_name+'" class="form-control">\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                    <div class="col-md-8">\n' +
            '                        <div class="text-right">\n' +
            '                            <button type="button" class="btn btn-link py-1 pb-2 h-auto px-2">Edit</button>\n' +
            '                            <button type="button" class="btn btn-link btn-link-danger py-1 pb-2 h-auto px-2" onclick="deleteProductVariantOption('+option_id+')">Remove</button>\n' +
            '                        </div>\n' +
            '                        <div class="form-group">\n' +
            '                            <input type="text" data-role="tagsinput"  name="product_variant_option['+option_id+'][values]" value="'+option_values+'" class="js-tags-input" placeholder="Separate options with a comma" />\n' +
            '                        </div>\n' +
            '                    </div>\n' +
            '                </div>';

        $('.js-product-variant-option').append(optionHtml);

        $("input[name='product_variant_option["+option_id+"][values]']").tagsinput()
    }


    var productVariantOptions = <?php echo json_encode($productVariantOptions); ?>;

    for (i = 0; i < productVariantOptions.length; i++) {
        option_values = productVariantOptions[i].option_values.join(', ');
        addProductVariantOption(i, productVariantOptions[i].option_name, option_values);
    }


    function deleteProductVariantOption(option_id) {
        $('.js-product-variant-option-' + option_id).remove();
        productVariantOptions.splice(0, option_id)
    }

    $(document).ready(function () {

       $('.js-product-has-variants').click(function () {
           $('.js-product-variants').toggle();
       });

       $('.js-add-variant-option').click(function () {
           if (productVariantOptions.length > 2) {
                alert('Maximum product variants are 3');
               return;
           }
           productVariantOptions.push({"option_name":"","option_values":[]});
           addProductVariantOption(productVariantOptions.length-1);

       });

        <?php if (!empty($productVariantOptions)): ?>
        $('.js-product-has-variants').click();
        <?php endif; ?>

    });
</script>

<div class="card style-1 mb-3">
    <div class="card-header no-border">
        <h6><strong>Variants</strong></h6>
    </div>

    <div class="card-body pt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input js-product-has-variants" id="the-product-has-variants">
                        <label class="custom-control-label" for="the-product-has-variants">This product has multiple options, like different sizes or colors</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="js-product-variants">
            <hr class="thin no-padding"/>

            <h6 class="text-uppercase mb-3"><strong>Create an option</strong></h6>

            <div class="options js-product-variant-option">

            </div>

            <hr class="thin" />

            <button type="button" class="btn btn-outline-primary text-dark js-add-variant-option">Add another option</button>

            <hr class="thin no-padding"/>

            <h6 class="text-uppercase mb-3"><strong>Preview</strong></h6>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="border-0">Variant</th>
                        <th scope="col" class="border-0">Price</th>
                        <th scope="col" class="border-0">Quantity</th>
                        <th scope="col" class="border-0">SKU</th>
                        <th scope="col" class="border-0">Actions</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <th scope="row" style="vertical-align: middle;">
                            <span>L / Red</span>
                        </th>
                        <td>
                            <div class="input-group prepend-transparent m-0">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-muted">BGN</span>
                                </div>
                                <input type="text" class="form-control" value="0.00">
                            </div>
                        </td>
                        <td>
                            <div class="input-group append-transparent input-group-quantity m-0">
                                <input type="text" class="form-control" value="0">
                                <div class="input-group-append">
                                    <div class="input-group-text plus-minus-holder">
                                        <button type="button" class="plus"><i class="mdi mdi-menu-up"></i></button>
                                        <button type="button" class="minus"><i class="mdi mdi-menu-down"></i></button>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group m-0">
                                <input type="text" class="form-control" value="">
                            </div>
                        </td>
                        <td style="vertical-align: middle;">
                            <div class="btn-group">
                                <button class="btn btn-outline-secondary btn-sm">Edit</button>
                                <button class="btn btn-outline-secondary btn-sm"><i class="mdi mdi-trash-can-outline"></i></button>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>