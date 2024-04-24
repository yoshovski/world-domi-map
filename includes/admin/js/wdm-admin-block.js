/* Block for Gutenberg */
wp.blocks.registerBlockType( 'world-domi-map/world-domination-map', {
    title: 'World DomiMap',
    icon: 'dashicons dashicons-admin-site-alt',
    category: 'widgets',
    description: "Display an interactive global map showcasing tracked projects completed in various countries.",
    example: {
    },
    edit: function() {
            return wp.element.createElement(wp.element.RawHTML, null, `<div class="wdm-map-container"><img src="${wdm_block_map_data.wdmPreviewImage}" alt="World Domi Map Preview" width="450" height="300"></div>`);
    },
    save: function() {
        return null;
    }
});


wp.data.subscribe(() => {
    const { getSelectedBlock } = wp.data.select('core/block-editor');

    const block = getSelectedBlock();

    if (block && block.name === 'world-domi-map/world-domination-map') {
        renderMap();
    }
});
