<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const desktopTooltip = document.getElementById("desktopTooltip");
        const mobileTooltip = document.getElementById("mobileTooltip");
        const mobileMenuTooltip = document.getElementById("mobileMenuTooltip");

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileTooltip.classList.remove("animate-pulse");
        });

        @if (request()->routeIs('pages.home'))
            if (desktopTooltip) {
                desktopTooltip.classList.add("animate-pulse");
                setTimeout(() => {
                    desktopTooltip.classList.remove("animate-pulse");
                }, 5000);
            }

            if (mobileTooltip) {
                mobileTooltip.classList.add("animate-pulse");
                setTimeout(() => {
                    mobileTooltip.classList.remove("animate-pulse");
                }, 5000);
            }

            if (mobileMenuTooltip) {
                mobileMenuTooltip.classList.add("animate-pulse");
                setTimeout(() => {
                    mobileMenuTooltip.classList.remove("animate-pulse");
                }, 5000);
            }
        @endif
    });
</script>
