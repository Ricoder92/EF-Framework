(function(wp) {

    // core 

    var el = wp.element.createElement;


    // register
    var registerBlockType = wp.blocks.registerBlockType;

    // editor stuff
    var InspectorControls = wp.editor.InspectorControls;
    var MediaUpload = wp.editor.MediaUpload;
    var RichText = wp.editor.RichText;

    // components
    var TextControl = wp.components.TextControl;
    var TextareaControl = wp.components.TextareaControl;
    var ColorPalette = wp.components.ColorPalette;
    var CheckboxControl = wp.components.CheckboxControl;
    var Button = wp.components.Button;
    var RangeControl = wp.components.RangeControl;
    var IconButton = wp.components.Button;
    var BaseControl = wp.components.BaseControl;
    var SelectControl = wp.components.SelectControl;
    var ToggleControl = wp.components.ToggleControl;
    var Panel = wp.components.Panel;
    var PanelBody = wp.components.PanelBody;

    // register
    registerBlockType('enfi/test', {

        title 'Enfi Test',
        icon: 'smiley',
        category: 'enfi-blocks',

        supports: {
            align: ['full', 'wide'],
            alignWide: true,
            html: true,
        },


        inserter: false,
        multiple: false,
        reusable: false,

        attributes: {
            title {
                type: 'string',
            },
            text: {
                type: 'string',
            },
            backgroundColor: {
                type: 'string',
                default: 'rgb(140,140,140)'
            },
            backgroundColortitle {
                type: 'string',
            },
            backgroundColorText: {
                type: 'string',
            },
            backgroundColorOpacity: {
                type: 'number',
                default: '100'
            },
            imageID: {
                type: 'number',
            },
            imageURL: {
                type: 'url',
                default: ''
            },
            ordertitle {
                type: 'string',
                default: 'order-first'
            },
            orderText: {
                type: 'string',
                default: 'order-last'
            },
            align: {
                type: 'string',
                default: 'full'
            },
            titleTextOrderState: {
                type: 'bool',
            },
            sideBySideState: {
                type: 'bool',
            },
            sideBySideValue: {
                type: 'string',
                default: 'col-lg-12'
            },
            sideBySideValueRowHeight: {
                type: 'string',
                default: ''
            },
            fluidState: {
                type: 'bool',
            },
            fluidValue: {
                type: 'string',
                default: ''
            },
            titleEffect: {
                type: 'string',
                default: ''
            },
            titleEffectDuration: {
                type: 'number',
                default: '200'
            },
            titleEffectDelay: {
                type: 'number',
                default: '0'
            },
            textEffect: {
                type: 'string',
                default: ''
            },
            textEffectDuration: {
                type: 'number',
                default: '200'
            },
            textEffectDelay: {
                type: 'number',
                default: '0'
            },
            titleColor: {
                type: 'string',
                default: 'rgb(255,255,255)'
            },
            textColor: {
                type: 'string',
                default: 'rgb(255,255,255)'
            },

        },


        edit: function(props) {

            // Text
            var title = props.attributes.title;
            var text = props.attributes.text;

            // Backround
            var backgroundColor = props.attributes.backgroundColor;
            var backgroundColorOpacity = props.attributes.backgroundColorOpacity;
            var backgroundColorTitle = props.attributes.backgroundColorTitle;
            var backgroundColorText = props.attributes.backgroundColorText;

            var imageID = props.attributes.imageID;
            var imageURL = props.attributes.imageURL;

            var titleEffect = props.attributes.titleEffect;
            var titleEffectDuration = props.attributes.titleEffectDuration;
            var titleEffectDelay = props.attributes.titleEffectDelay;

            var textEffect = props.attributes.textEffect;
            var textEffectDuration = props.attributes.textEffectDuration;
            var textEffectDelay = props.attributes.textEffectDelay;

            var titleColor = props.attributes.titleColor;
            var textColor = props.attributes.textColor;

            var sideBySideValue = props.attributes.sideBySideValue;
            var sideBySideValueRowHeight = props.attributes.sideBySideValueRowHeight;
            var sideBySideState = props.attributes.sideBySideState;

            var fluidState = props.attributes.fluidState;
            var fluidValue = props.attributes.fluidValue;

            var titleTextOrderState = props.attributes.titleTextOrderState
            var orderTitle = props.attributes.orderTitle;
            var orderText = props.attributes.orderText;

            var colors = [{
                    name: "red",
                    color: "#ff0000"
                },
                {
                    name: "green",
                    color: "#00ff00"
                },
                {
                    name: "blue",
                    color: "#0000ff"
                },
                {
                    name: "orange",
                    color: "orange"
                },
                {
                    name: "purple",
                    color: "purple"
                },
                {
                    name: "azure",
                    color: "azure"
                },
                {
                    name: "gray",
                    color: "gray"
                },
                {
                    name: "white",
                    color: "#fff"
                },
                {
                    name: "black",
                    color: "#000"
                }
            ];

            var tittleEffectOptions = [{
                    label: 'Einblenden',
                    value: 'fade'
                },
                {
                    label: 'Einblenden von oben',
                    value: 'fade-up'
                },
                {
                    label: 'Einblenden von unten',
                    value: 'fade-down'
                },
                {
                    label: 'Einblenden nach links',
                    value: 'fade-left'
                },
                {
                    label: 'Einblenden nach rechts',
                    value: 'fade-right'
                },
                {
                    label: 'Einblenden nach oben nach rechts',
                    value: 'fade-up-right'
                },
                {
                    label: 'Einblenden nach oben nach links',
                    value: 'fade-up-left'
                },
                {
                    label: 'Einblenden nach unten nach rechts',
                    value: 'fade-down-right'
                },
                {
                    label: 'Einblenden nach unten nach rechts',
                    value: 'fade-down-left'
                },
                {
                    label: 'Drehen',
                    value: 'flip-up'
                },
                {
                    label: 'Drehen nach unten',
                    value: 'flip-down'
                },
                {
                    label: 'Drehen von links',
                    value: 'flip-left'
                },
                {
                    label: 'Drehen von rechts',
                    value: 'flip-right'
                },
                {
                    label: 'Sliden von oben',
                    value: 'slide-up'
                },
                {
                    label: 'Sliden von unten',
                    value: 'slide-down'
                },
                {
                    label: 'Sliden nach links',
                    value: 'slide-left'
                },
                {
                    label: 'Sliden nach rechts',
                    value: 'slide-right'
                },
                {
                    label: 'Reinzoomen',
                    value: 'zoom-in'
                },
                {
                    label: 'Reinzoomen von oben',
                    value: 'zoom-in-up'
                },
                {
                    label: 'Reinzoomen von unten',
                    value: 'zoom-in-down'
                },
                {
                    label: 'Reinzoomen von links',
                    value: 'zoom-in-left'
                },
                {
                    label: 'Reinzoomen von rechts',
                    value: 'zoom-in-right'
                },
                {
                    label: 'Rauszoomen',
                    value: 'zoom-out'
                },
                {
                    label: 'Rauszoomen von oben',
                    value: 'zoom-out-up'
                },
                {
                    label: 'Rauszoomen von unten',
                    value: 'zoom-out-down'
                },
                {
                    label: 'Rauszoomen von links',
                    value: 'zoom-out-left'
                },
                {
                    label: 'Rauszoomen von rechts',
                    value: 'zoom-out-right'
                }
            ]



            function onChangeTitle(newContent) {
                props.setAttributes({
                    title newContent
                });
            }

            function onChangeText(newContent) {
                props.setAttributes({
                    text: newContent
                });
            }

            function onChangeBackgroundColor(newColor) {
                props.setAttributes({
                    backgroundColor: newColor
                });

            }

            function onChangeBackgroundColorTitle(newColor) {
                props.setAttributes({
                    backgroundColortitle newColor
                });
            }

            function onChangeBackgroundColorText(newColor) {
                props.setAttributes({
                    backgroundColorText: newColor
                });
            }

            function onChangeTitleColor(newColor) {
                props.setAttributes({
                    titleColor: newColor
                });
            }

            function onChangeTextColor(newColor) {
                props.setAttributes({
                    textColor: newColor
                });
            }

            function onChangeSwitchTitleText(state) {

                if (state) {
                    props.setAttributes({
                        ordertitle 'order-last',
                        orderText: 'order-first'
                    });
                } else {
                    props.setAttributes({
                        ordertitle 'order-first',
                        orderText: 'order-last'
                    });
                }

                return props.setAttributes({
                    titleTextOrderState: state
                });

            }

            function onChangeTitleEffect(state) {
                return props.setAttributes({
                    titleEffect: state
                });
            }

            function onChangeTitleEffectDuration(state) {
                return props.setAttributes({
                    titleEffectDuration: state
                });
            }

            function onChangeTitleEffectDelay(state) {
                return props.setAttributes({
                    titleEffectDelay: state
                });
            }

            function onChangeTextEffect(state) {
                return props.setAttributes({
                    textEffect: state
                });
            }

            function onChangeTextEffectDuration(state) {
                return props.setAttributes({
                    textEffectDuration: state
                });
            }

            function onChangeTextEffectDelay(state) {
                return props.setAttributes({
                    textEffectDelay: state
                });
            }


            function onChangesideBySideState(state) {

                if (state) {
                    props.setAttributes({
                        sideBySideValue: 'col-lg-6',
                        sideBySideValueRowHeight: 'h-100'
                    });
                } else {
                    props.setAttributes({
                        sideBySideValue: 'col-lg-12',
                        sideBySideValueRowHeight: ''
                    });
                }

                return props.setAttributes({
                    sideBySideState: state
                });
            }

            function onChangeBackgroundColorOpacity(state) {
                return props.setAttributes({
                    backgroundColorOpacity: state
                });
            }

            function onChangeWide(state) {
                if (state) {
                    props.setAttributes({
                        fluidValue: '-fluid'
                    });
                } else {
                    props.setAttributes({
                        fluidValue: ''
                    });
                }

                return props.setAttributes({
                    fluidState: state
                });
            }

            var onSelectImage = function(media) {
                return props.setAttributes({
                    imageURL: media.url,
                    imageID: media.id,
                });
            };

            return el(
                'div', {
                    className: props.className,

                },
                el('div', {
                    className: 'bg-image',
                    style: {
                        backgroundImage: 'url(' + imageURL + ')',
                        opacity: backgroundColorOpacity / 100
                    }
                }),

                el('div', {
                        className: 'bg-color',
                        style: {
                            backgroundColor: backgroundColor,
                        }
                    },
                    el('div', {
                            className: 'content'
                        },

                        el('div', {
                                className: 'container' + fluidValue + ' ' + sideBySideValueRowHeight
                            },

                            el('div', {
                                    className: 'row ' + sideBySideValueRowHeight
                                },

                                el('div', {
                                        className: 'col-center ' + sideBySideValue + ' ' + orderTitle,
                                        style: {
                                            backgroundColor: backgroundColorTitle,
                                            color: titleColor
                                        }
                                    },
                                    el(RichText, {
                                        key: 'editable',
                                        tagName: 'h1',
                                        placeholder: 'Überschrift eingeben...',
                                        onChange: onChangeTitle,
                                        value: title,
                                    })
                                ),
                                el('div', {
                                        className: 'col-center ' + sideBySideValue + ' ' + orderText,
                                        style: {
                                            backgroundColor: backgroundColorText,
                                            color: textColor
                                        }
                                    },
                                    el(RichText, {
                                        key: 'editable',
                                        tagName: 'p',
                                        placeholder: 'Text eingeben...',
                                        onChange: onChangeText,
                                        value: text,
                                    })
                                ),
                            )
                        ),

                        el(InspectorControls, null,

                            el(PanelBody, {
                                    title "Text",
                                    initialOpen: false
                                },

                                el(ToggleControl, {
                                    label: "Vertausche Titel und Text",
                                    checked: titleTextOrderState,
                                    onChange: onChangeSwitchTitleText
                                }),
                                el(ToggleControl, {
                                    label: "Nebeneinander",
                                    checked: sideBySideState,
                                    onChange: onChangesideBySideState
                                }),
                                el(ToggleControl, {
                                    label: "gestreckt?",
                                    checked: fluidState,
                                    onChange: onChangeWide
                                })
                            ),
                            el(PanelBody, {
                                    title 'Text-Eigenschaften',
                                    initialOpen: false
                                },
                                el(BaseControl, {
                                    label: 'Titel Schriftfarbe'
                                }),
                                el(ColorPalette, {
                                    colors: colors,
                                    value: titleColor,
                                    onChange: onChangeTitleColor
                                }),
                                el(BaseControl, {
                                    label: 'Text Schriftfarbe'
                                }),
                                el(ColorPalette, {
                                    colors: colors,
                                    value: textColor,
                                    onChange: onChangeTextColor
                                }),

                            ),

                            el(PanelBody, {
                                    title "Hintergrund",
                                    initialOpen: false
                                },
                                el(BaseControl, {
                                    label: 'Hintergrundfarbe'
                                }),
                                el(ColorPalette, {
                                    colors: colors,
                                    value: backgroundColor,
                                    onChange: onChangeBackgroundColor
                                }),
                                el(BaseControl, {
                                    label: 'Titel Hintergrundfarbe'
                                }),
                                el(ColorPalette, {
                                    colors: colors,
                                    value: backgroundColorTitle,
                                    onChange: onChangeBackgroundColorTitle
                                }),
                                el(BaseControl, {
                                    label: 'Text Hintergrundfarbe'
                                }),
                                el(ColorPalette, {
                                    colors: colors,
                                    value: backgroundColorText,
                                    onChange: onChangeBackgroundColorText
                                }),
                                el(RangeControl, {
                                    label: 'Deckkraft',
                                    value: backgroundColorOpacity,
                                    onChange: onChangeBackgroundColorOpacity,
                                    min: 0,
                                    max: 100,
                                }),
                                el(MediaUpload, {
                                    onSelect: onSelectImage,
                                    type: 'image',
                                    value: props.imageID,
                                    render: function(obj) {
                                        return el(IconButton, {
                                            className: props.imageID ? 'image-button' : 'button button-large',
                                            onClick: obj.open
                                        }, !props.imageID ? 'Hintergrundbild festlegen' : el('img', {
                                            src: props.imageURL
                                        }));
                                    }
                                })
                            ),
                            el(PanelBody, {
                                    title "Animation",
                                    initialOpen: false
                                },
                                el(SelectControl, {
                                    label: 'Titel-Effekt',
                                    value: titleEffect,
                                    options: tittleEffectOptions,
                                    onChange: onChangeTitleEffect
                                }),
                                el(RangeControl, {
                                    label: 'Titel-Effekt Dauer',
                                    value: titleEffectDuration,
                                    onChange: onChangeTitleEffectDuration,
                                    min: 100,
                                    max: 2000,
                                }),
                                el(RangeControl, {
                                    label: 'Titel-Effekt Verzögerung',
                                    value: titleEffectDelay,
                                    onChange: onChangeTitleEffectDelay,
                                    min: 0,
                                    max: 2000,
                                }),
                                el(SelectControl, {
                                    label: 'Text-Effekt',
                                    value: textEffect,
                                    options: tittleEffectOptions,
                                    onChange: onChangeTextEffect
                                }),
                                el(RangeControl, {
                                    label: 'Text-Effekt Dauer',
                                    value: textEffectDuration,
                                    onChange: onChangeTextEffectDuration,
                                    min: 100,
                                    max: 2000,
                                }),
                                el(RangeControl, {
                                    label: 'Text-Effekt Verzögerung',
                                    value: textEffectDelay,
                                    onChange: onChangeTextEffectDelay,
                                    min: 0,
                                    max: 2000,
                                }),
                            )
                        )
                    )
                )

            );
        },

        save: function(props) {
            var title = props.attributes.title;
            var text = props.attributes.text;
            var backgroundColor = props.attributes.backgroundColor;
            var backgroundColorTitle = props.attributes.backgroundColorTitle;
            var backgroundColorText = props.attributes.backgroundColorText;
            var backgroundColorOpacity = props.attributes.backgroundColorOpacity;
            var imageID = props.attributes.imageID;
            var imageURL = props.attributes.imageURL;
            var sideBySideValue = props.attributes.sideBySideValue;
            var sideBySideValueRowHeight = props.attributes.sideBySideValueRowHeight;
            var orderTitle = props.attributes.orderTitle;
            var orderText = props.attributes.orderText;
            var fluidValue = props.attributes.fluidValue;
            var titleEffect = props.attributes.titleEffect;
            var titleEffectDuration = props.attributes.titleEffectDuration;
            var titleEffectDelay = props.attributes.titleEffectDelay;

            var textEffect = props.attributes.textEffect;
            var textEffectDuration = props.attributes.textEffectDuration;
            var textEffectDelay = props.attributes.textEffectDelay;

            var titleColor = props.attributes.titleColor;
            var textColor = props.attributes.textColor;


            return el(
                'div', {
                    className: props.className,
                },
                el('div', {
                    className: 'bg-image',
                    style: {
                        backgroundImage: 'url(' + imageURL + ')',
                        opacity: backgroundColorOpacity / 100
                    }
                }),

                el('div', {
                        className: 'bg-color',
                        style: {
                            backgroundColor: backgroundColor,
                        }
                    },
                    el('div', {
                            className: 'content'
                        },
                        el('div', {
                                className: 'container' + fluidValue + ' ' + sideBySideValueRowHeight,
                            },

                            el('div', {
                                    className: 'row ' + sideBySideValueRowHeight
                                },

                                el('div', {
                                        className: 'col-center ' + sideBySideValue + ' ' + orderTitle,
                                        'data-aos': titleEffect,
                                        'data-aos-duration': titleEffectDuration,
                                        'data-aos-delay': titleEffectDelay,
                                        style: {
                                            backgroundColor: backgroundColorTitle,
                                            color: titleColor
                                        }
                                    },
                                    el('h1', null, title)
                                ),
                                el('div', {
                                        className: 'col-center ' + sideBySideValue + ' ' + orderText,
                                        'data-aos': textEffect,
                                        'data-aos-duration': textEffectDuration,
                                        'data-aos-delay': textEffectDelay,
                                        style: {
                                            backgroundColor: backgroundColorText,
                                            color: textColor
                                        }
                                    },
                                    el('p', null, text)
                                ),
                            )
                        )
                    )
                )
            )
        }
    });


})(window.wp);