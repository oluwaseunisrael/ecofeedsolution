const blogGrid = document.querySelector('.blog-grid');
        let isDragging = false;
        let startX, scrollLeft;

        blogGrid.addEventListener('mousedown', (e) => {
            isDragging = true;
            startX = e.pageX - blogGrid.offsetLeft;
            scrollLeft = blogGrid.scrollLeft;
        });

        blogGrid.addEventListener('mouseleave', () => {
            isDragging = false;
        });

        blogGrid.addEventListener('mouseup', () => {
            isDragging = false;
        });

        blogGrid.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - blogGrid.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed
            blogGrid.scrollLeft = scrollLeft - walk;
        });

        // Touch events for mobile devices
        blogGrid.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].pageX - blogGrid.offsetLeft;
            scrollLeft = blogGrid.scrollLeft;
        });

        blogGrid.addEventListener('touchend', () => {
            isDragging = false;
        });

        blogGrid.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.touches[0].pageX - blogGrid.offsetLeft;
            const walk = (x - startX) * 2; // Scroll speed
            blogGrid.scrollLeft = scrollLeft - walk;
        });