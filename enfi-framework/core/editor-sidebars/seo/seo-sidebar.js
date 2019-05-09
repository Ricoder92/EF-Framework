( function( wp ) {

    
    var registerPlugin = wp.plugins.registerPlugin;
    var PluginSidebar = wp.editPost.PluginSidebar;
    var el = wp.element.createElement;
    var withSelect = wp.data.withSelect;
    var withDispatch = wp.data.withDispatch;
    var compose = wp.compose.compose;
    
    var BaseControl = wp.components.BaseControl;
    var Text = wp.components.TextControl;
    var Checkbox  = wp.components.CheckboxControl;


    registerPlugin( 'my-plugin-sidebar', {
        render: function() {
            return el( PluginSidebar,
                {
                    name: 'my-plugin-sidebar',
                    icon: 'admin-post',
                    title: 'My plugin sidebar',
                },
                el( 'div',
                    { className: 'ef-sidebar-content' },
                    
                    el( Checkbox,
                        { 
                        label: 'Disable' }
                    ),
                    el( Checkbox,
                        { 
                        label:"No Index" }
                    ),       
                    el( Text,
                        { label: 'Text1' }
                    ),
                    el( Text,
                        { label: 'Text1' }
                    ),
                    el( Text,
                        { label: 'Text1' }
                    ),
                    el( Text,
                        { label: 'Text1' }
                    ),
                    el( Text,
                        { label: 'Text1' }
                    ),
                    el( Text,
                        { label: 'Text1' }
                    ),
                )
            );
        }
    } );
} )( window.wp );

