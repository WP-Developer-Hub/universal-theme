document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded'); // Check if DOMContentLoaded event fires

    function fetchBlockPatterns() {
        console.log('Fetching block patterns...');

        wp.apiFetch({
            path: '/wp/v2/block-patterns/patterns'
        }).then(function(patterns) {
            console.log('Block patterns fetched:', patterns);
            displayBlockPatterns(patterns);
        }).catch(function(error) {
            console.error('Error fetching block patterns:', error);
        });
    }

    function displayBlockPatterns(patterns) {
        console.log('Displaying block patterns:', patterns);
        var metaboxContainer = document.getElementById('block-pattern');
        console.log('Metabox container:', metaboxContainer);

        // Clear previous content
        metaboxContainer.innerHTML = '';

        // Create and populate the area selection dropdown
        var areaSelect = document.createElement('select');
        areaSelect.id = 'block-pattern-area';

        var areas = ['Header', 'Footer', 'Content'];

        areas.forEach(function(area) {
            var option = document.createElement('option');
            option.value = area.toLowerCase();
            option.textContent = area;
            areaSelect.appendChild(option);
        });

        // Append area selection dropdown to the container
        metaboxContainer.appendChild(areaSelect);

        // Event listener for area selection
        areaSelect.addEventListener('change', function() {
            var selectedArea = this.value;
            var patternList = document.createElement('ul');

            patterns.forEach(function(pattern) {
//                var patternTitle = pattern.title.rendered;
//                var patternContent = pattern.content.raw;
//
//                // Check if pattern title contains the selected area
//                if (patternTitle.toLowerCase().includes(selectedArea.toLowerCase())) {
//                    var listItem = document.createElement('li');
//                    listItem.innerHTML = `<strong>${patternTitle}</strong><br>${patternContent}`;
//                    patternList.appendChild(listItem);
//                }
            });

            // Clear and update pattern list based on selected area
            metaboxContainer.innerHTML = ''; // Clear previous content
            metaboxContainer.appendChild(areaSelect); // Re-append area selection dropdown
            metaboxContainer.appendChild(patternList); // Append updated pattern list
        });
    }

    // Call fetchBlockPatterns when DOM is loaded
    fetchBlockPatterns();
});
