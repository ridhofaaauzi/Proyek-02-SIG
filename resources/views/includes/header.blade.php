<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const mobileMenu = document.getElementById('mobileMenu');
        const desktopTooltip = document.getElementById("desktopTooltip");
        const mobileTooltip = document.getElementById("mobileTooltip");
        const mobileMenuTooltip = document.getElementById("mobileMenuTooltip");

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            mobileTooltip.classList.remove("animate-blink");
        });

        @if (request()->routeIs('pages.home'))
            if (desktopTooltip) {
                desktopTooltip.classList.add("animate-blink");
                setTimeout(() => {
                    desktopTooltip.classList.remove("animate-blink");
                }, 6750);
            }

            if (mobileTooltip) {
                mobileTooltip.classList.add("animate-blink");
                setTimeout(() => {
                    mobileTooltip.classList.remove("animate-blink");
                }, 6750);
            }

            if (mobileMenuTooltip) {
                mobileMenuTooltip.classList.add("animate-blink");
                setTimeout(() => {
                    mobileMenuTooltip.classList.remove("animate-blink");
                }, 6750);
            }
        @endif
    });
</script>
