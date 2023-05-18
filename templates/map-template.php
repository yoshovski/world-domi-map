<div class="stats-section world-domination">
    <header>
        <h2 class="section-header tbody-4">World Domination 18%</h2>
    </header>
    <div class="world-map-wrapper">
        <script>
            var countryPaths = <?php echo json_encode($country_paths); ?>;

            // Generate the map SVG code using the map generator function
            var svgCode = '<?php echo wdm_generate_map(); ?>';

            // Output the generated SVG code
            document.write(svgCode);

            // Initialize tooltips using react-tooltip library
            ReactTooltip.rebuild();
        </script>

        <script src="<https://cdnjs.cloudflare.com/ajax/libs/react-tooltip/3.11.7/react-tooltip.min.js>"></script>
        <link rel="stylesheet" href="<https://cdnjs.cloudflare.com/ajax/libs/react-tooltip/3.11.7/react-tooltip.min.css>" />
        <script>
            ReactTooltip.defaultOptions = {
                place: 'top',
                effect: 'solid'
            };
        </script>
    </div>
</div>