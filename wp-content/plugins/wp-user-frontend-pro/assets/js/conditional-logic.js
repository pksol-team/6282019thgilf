(function($) {

    var conditional_logic = {

        init: function() {

            var _this = this;
            _this.change();

            // events
            $(document).on( 'change', '.wpuf-fields input, .wpuf-fields textarea, .wpuf-fields select', function(){
                _this.change();
            });
        },

        change: function() {

            var cond_field_val = [],
                all = [],
                prefix = 'wpuf_';

            if ( typeof wpuf_conditional_items === 'undefined' ) {
                return;
            }

            $.each( wpuf_conditional_items, function( k, item ) {

                $.each( item.cond_field, function( key, value ) {

                    var form_id     = '_' + item.form_id,
                        selector    = '.' + prefix + value + form_id,
                        value       = item.cond_option[key],
                        operator    = ( item.cond_operator[key] == '=' ) ? true : false,
                        select      = $('select'+selector),
                        checkbox    = $('input[type=checkbox][value="' + value + '"]' + selector ),
                        radio       = $('input[type=radio][value="' + value+'"]'+ selector),
                        select      = $('select' + selector + '>option[value="' + value + '"]');

                    if ( select.length ) {

                        var select_selectd_status = select.is(':selected') ? true : false;

                        if ( operator && select_selectd_status  ) {
                            all[key] = true;

                        } else if ( operator === false && select_selectd_status === false ) {
                            all[key] = true;

                        } else {
                            all[key] = false;
                        }
                    }

                    if ( radio.length ) {

                        var radio_checked_status = radio.is(':checked') ? true : false;

                        if ( operator && radio_checked_status  ) {

                            all[key] = true;

                        } else if ( operator === false && radio_checked_status === false ) {

                            all[key] = true;

                        } else {
                            all[key] = false;
                        }
                    }

                    if ( checkbox.length ) {

                        var checkbox_checked_status = checkbox.is(':checked') ? true : false;

                        if( operator && checkbox_checked_status  ) {
                            all[key] = true;

                        } else if ( operator === false && checkbox_checked_status === false ) {
                            all[key] = true;

                        } else {
                            all[key] = false;
                        }
                    }
                });

                var field_selector = '.' + prefix + item.name + '_' + item.form_id;

                if ( item.cond_logic == 'any') {

                    var check = all.indexOf( true );

                    if ( check != '-1') {

                        if ( item.type == 'address' ) {
                            $( 'li.wpuf-el.' + item.name ).show();
                        } else {
                            $( field_selector ).closest('li').show();
                        }

                    } else {

                        if ( item.type == 'address' ) {
                            $( 'li.wpuf-el.' + item.name ).hide();
                        } else {
                            $( field_selector ).closest('li').hide();

                            if ( item.type == 'checkbox' || item.type == 'radio' || item.type == 'taxonomy' ) {
                                $( field_selector ).closest('li').find(':input').each( function() {
                                    this.checked = false;
                                });
                            }  else if ( item.type == 'submit' ) {
                                // do nothing
                            } else {
                                $( field_selector ).closest('li').find(':input').val('');
                            }
                        }

                    }

                } else {

                    var check = all.indexOf( false );

                    if ( check == '-1') {

                        if ( item.type == 'address' ) {
                            $( 'li.wpuf-el.' + item.name ).show();
                        } else {
                            $( field_selector ).closest('li').show();
                        }

                    } else {

                        if ( item.type == 'address' ) {
                            $( 'li.wpuf-el.' + item.name ).hide();
                        } else {
                            $( field_selector ).closest('li').hide();

                            if ( item.type == 'checkbox' || item.type == 'radio' || item.type == 'taxonomy' ) {
                                $( field_selector ).closest('li').find(':input').each( function() {
                                    this.checked = false;
                                });
                            } else if ( item.type == 'submit' ) {
                                // do nothing
                            } else {
                                $( field_selector ).closest('li').find(':input').val('');
                            }
                        }
                    }

                }

                all.length = 0;
            });
        }
    }

    conditional_logic.init();
})(jQuery);
