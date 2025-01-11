<script>
    document.addEventListener('DOMContentLoaded', () => {
        const copyButton = document.getElementById('copyButton');
        const copyPopup = document.getElementById('copyPopup');

        if (copyButton && copyPopup) {
            copyButton.addEventListener('click', () => {
                const baseUrl = window.location.origin;

                const urlParams = new URLSearchParams(window.location.search);
                const districtId = urlParams.get('district');
                const birthYear = urlParams.get('year');

                const queryParams = [];
                if (districtId) queryParams.push(`district=${districtId}`);
                if (birthYear) queryParams.push(`year=${birthYear}`);
                const queryString = queryParams.length > 0 ? `?${queryParams.join('&')}` : '';

                const fullUrl = `${baseUrl}/${queryString}`;

                navigator.clipboard.writeText(fullUrl).then(() => {
                    const popup = document.getElementById('copyPopup');
                    popup.classList.remove('opacity-0', 'pointer-events-none');
                    popup.classList.add('opacity-100');

                    setTimeout(() => {
                        popup.classList.add('opacity-0', 'pointer-events-none');
                        popup.classList.remove('opacity-100');
                    }, 2000);
                }).catch(err => {
                    console.error('Failed to copy the link:', err);
                });
            });
        } else {
            console.error('Copy button or popup element not found in the DOM.');
        }
    });
</script>
