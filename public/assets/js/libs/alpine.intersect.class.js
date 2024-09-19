;(() => {
  function c(e) {
    e.directive('intersect-class', (n, { expression: i, modifiers: s }, { cleanup: l }) => {
      let r = i.split(' ').filter(Boolean),
        t = new IntersectionObserver(
          (o) => {
            o.forEach((u) => {
              if (!u.isIntersecting) {
                n.classList.remove(...r)
                return
              }
              n.classList.add(...r), s.includes('once') && t.disconnect()
            })
          },
          { threshold: d(s) }
        )
      t.observe(n),
        l(() => {
          t.disconnect()
        })
    })
  }
  function d(e) {
    if (e.includes('full')) return 0.99
    if (e.includes('half')) return 0.5
    if (!e.includes('threshold')) return 0
    let n = e[e.indexOf('threshold') + 1]
    return n === '1' ? 1 : +`.${n}`
  }
  document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(c)
  })
})()
