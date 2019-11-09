(function ($) {
    'use strict';

    /*[ Wizard Config ]
        ===========================================================*/
    
    try {
        var $validator = $("#js-wizard-form").validate({
            rules: {
                companyName: {
                    required: true,
                    minlength: 3
                },
                reportPeriod: {
                    required: true,
                    minlength: 3
                },
                currencyUnit: {
                    required: true,
                    minlength: 3
                },
                fileToUpload: {
                    required: true
                }
            },
            messages: {
                companyName: {
                    required: "Введите имя компании"
                },

                reportPeriod: {
                    required: "Введите отчетный период"
    
                },
                currencyUnit: {
                    required: "Введите денежную единицу баланса"
                },
                fileToUpload: {
                    required: "Прикрепите файл"
                }
            }
        });
    
        $("#js-wizard-form").bootstrapWizard({
            'tabClass': 'nav nav-pills',
            'nextSelector': '.btn--next',
            'onNext': function(tab, navigation, index) {
                var $valid = $("#js-wizard-form").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            },
            'onTabClick': function (tab, navigation, index) {
                var $valid = $("#js-wizard-form").valid();
                if(!$valid) {
                    $validator.focusInvalid();
                    return false;
                }
            }
    
        });
    
    }
    catch (e) {
        console.log(e)
    }

})(jQuery);