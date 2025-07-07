document.addEventListener('DOMContentLoaded', function () {
;
    // Trigger progress bar animation after page load
    setTimeout(() => {
        const progressBar = document.querySelector('.animate-progress');
        if (progressBar) {
            progressBar.style.animationPlayState = 'running';
        }
    }, 800);

    // Add subtle sparkle effect
    function createSparkle() {
        const sparkle = document.createElement('div');
        sparkle.style.position = 'absolute';
        sparkle.style.width = '4px';
        sparkle.style.height = '4px';
        sparkle.style.backgroundColor = '#3b82f6';
        sparkle.style.borderRadius = '50%';
        sparkle.style.opacity = '0';
        sparkle.style.pointerEvents = 'none';
        sparkle.style.zIndex = '5';

        // Random position
        sparkle.style.left = Math.random() * window.innerWidth + 'px';
        sparkle.style.top = Math.random() * window.innerHeight + 'px';

        document.body.appendChild(sparkle);

        // Animate sparkle
        sparkle.animate([
            { opacity: 0, transform: 'scale(0)' },
            { opacity: 1, transform: 'scale(1)' },
            { opacity: 0, transform: 'scale(0)' }
        ], {
            duration: 2000,
            easing: 'ease-in-out'
        }).onfinish = () => {
            document.body.removeChild(sparkle);
        };
    }

    // Create sparkles periodically
    setInterval(createSparkle, 3000);
});

// Add hover effect to the main heading
document.querySelector('h1').addEventListener('mouseenter', function () {
    this.style.color = '#3b82f6';
    this.style.transition = 'color 0.3s ease';
});

document.querySelector('h1').addEventListener('mouseleave', function () {
    this.style.color = '#111827';
});
