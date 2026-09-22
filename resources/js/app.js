import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

const revealElements = document.querySelectorAll('[data-reveal]')

if (revealElements.length > 0) {
    const revealObserver = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return
                }

                entry.target.classList.add('is-visible')

                revealObserver.unobserve(entry.target)
            })
        },
        {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px',
        }
    )

    revealElements.forEach((element) => {
        revealObserver.observe(element)
    })
}