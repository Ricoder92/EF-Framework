(function(blocks, element) {
    var el = element.createElement;

    blocks.registerBlockType('ef-slider/slide', {
        title: 'EF Slide',
        icon: 'universal-access-alt',
        category: 'ef-slider',
        edit: function() {
            return 'div', '', el('div', { className: 'ef-slide' }, 'test')
        },
        save: function() {
            return 'div', '', el('div', { className: 'ef-slide' }, 'test')
        },
    });
}(
    window.wp.blocks,
    window.wp.element
));