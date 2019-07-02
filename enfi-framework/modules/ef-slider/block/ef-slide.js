(function(blocks, element) {
    var el = element.createElement;

    blocks.registerBlockType('ef-swiper/slide', {
        title: 'EF Slide',
        icon: 'universal-access-alt',
        category: 'ef-swiper',
        edit: function() {
            return 'div', '', el('div', { className: 'ef-swiper-slide' }, 'test')
        },
        save: function() {
            return 'div', '', el('div', { className: 'ef-swiper-slide' }, 'test')
        },
    });
}(
    window.wp.blocks,
    window.wp.element
));