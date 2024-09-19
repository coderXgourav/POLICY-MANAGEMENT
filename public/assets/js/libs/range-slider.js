/* 
Tool Cool Range Slider v4.0.28
https://github.com/mzusin/toolcool-range-slider
MIT License        
Copyright (c) 2022-present, Miriam Zusin          
*/
;(() => {
  var jn = Object.defineProperty
  var Et = Math.pow,
    qn = (r, i, t) => (i in r ? jn(r, i, { enumerable: !0, configurable: !0, writable: !0, value: t }) : (r[i] = t))
  var ae = (r, i, t) => (qn(r, typeof i != 'symbol' ? i + '' : i, t), t)
  var St = (r, i) =>
    ` ${i && i.length > 0 ? i.map((t) => `<link rel="stylesheet" href="${t}" />`).join('') : ''} <style> ${r} </style> <div class="range-slider-box"> <div class="row"> <div id="range-slider" class="range-slider"> <div class="container"> <div class="panel"></div> <div class="panel-fill"></div> <div class="container"> <div class="pointer" tabindex="0" role="slider"> <div class="pointer-shape"></div> </div> </div> </div> </div> </div> </div>`
  var Tt =
    ':host{--width:300px;--height:.25rem;--opacity:.4;--panel-bg:#cbd5e1;--panel-bg-hover:#94a3b8;--panel-bg-fill:#475569;--panel-bg-border-radius:1rem;--pointer-width:1rem;--pointer-height:1rem;--pointer-bg:#fff;--pointer-bg-hover:#dcdcdc;--pointer-bg-focus:#dcdcdc;--pointer-shadow:0 0 2px rgba(0,0,0,0.8);--pointer-shadow-hover:0 0 2px #000;--pointer-shadow-focus:var(--pointer-shadow-hover);--pointer-border:1px solid hsla(0,0%,88%,0.5);--pointer-border-hover:1px solid #94a3b8;--pointer-border-focus:var(--pointer-border-hover);--pointer-border-radius:100%;--animate-onclick:.3s}:host{max-width:100%}.range-slider-box{display:flex;position:relative;flex-direction:column}.range-slider{position:relative;width:var(--width,100%);height:var(--height,0.25rem);touch-action:none;max-width:100%;box-sizing:border-box;cursor:pointer}.row{width:100%;display:flex;align-items:center}.range-slider.disabled{opacity:var(--opacity,0.4);cursor:default}.pointer.disabled{-webkit-filter:brightness(0.8);filter:brightness(0.8);cursor:default}.range-slider *{box-sizing:border-box}.container{position:absolute;width:100%;height:100%}.panel{position:absolute;z-index:10;width:100%;height:100%;background:var(--panel-bg,#2d4373);border-radius:var(--panel-bg-border-radius,1rem);overflow:hidden;transition:.3s all ease}.panel-fill{background:var(--panel-bg-fill,#000);border-radius:var(--panel-bg-border-radius,1rem);overflow:hidden;height:100%;position:absolute;z-index:10}.panel:hover{background:var(--panel-bg-hover,#5f79b7)}.disabled .panel:hover{background:var(--panel-bg,#5f79b7)}.pointer{position:absolute;z-index:20;outline:0;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%)}.pointer-shape{background:var(--pointer-bg,#fff);background-size:contain;box-shadow:var(--pointer-shadow);border:var(--pointer-border);border-radius:var(--pointer-border-radius,100%);-webkit-transform:translateX(-50%);transform:translateX(-50%);width:var(--pointer-width,15px);height:var(--pointer-height,15px);transition:.3s all ease}.pointer-shape:hover{background:var(--pointer-bg-hover,#fff);background-size:contain;border:var(--pointer-border-hover);box-shadow:var(--pointer-shadow-hover)}.disabled .pointer-shape:hover{background:var(--pointer-bg,#fff);background-size:contain;border:var(--pointer-border);box-shadow:var(--pointer-shadow)}.pointer:focus .pointer-shape{background:var(--pointer-bg-focus,#fff);background-size:contain;border:var(--pointer-border-focus);box-shadow:var(--pointer-shadow-focus)}.disabled .pointer:focus .pointer-shape{background:var(--pointer-bg,#fff);background-size:contain;border:var(--pointer-border);box-shadow:var(--pointer-shadow)}.type-vertical .range-slider{--width:.25rem;--height:300px;max-height:100%}.type-vertical .range-slider .pointer{left:50%}.type-vertical .range-slider .panel-fill{width:100%}.type-vertical.range-slider-box{flex-direction:row}.type-vertical .row{flex-direction:column}.animate-on-click .pointer,.animate-on-click .panel-fill{transition:all var(--animate-onclick)}.range-dragging .panel-fill{cursor:move}'
  var le = 'pointers-overlap',
    ue = 'pointers-min-distance',
    de = 'pointers-max-distance',
    ce = 'range-dragging',
    pe = 'data',
    be = 'min',
    ge = 'max',
    fe = 'step',
    me = 'round',
    he = 'type',
    ve = 'theme',
    ye = 'rtl',
    xe = 'btt',
    Pe = 'disabled',
    Ee = 'keyboard-disabled',
    Se = 'mousewheel-disabled',
    At = 'slider-width',
    Mt = 'slider-height',
    wt = 'slider-radius',
    Dt = 'slider-bg',
    Lt = 'slider-bg-hover',
    Ct = 'slider-bg-fill',
    kt = 'pointer-width',
    Ht = 'pointer-height',
    It = 'pointer-radius',
    Rt = 'pointer-bg',
    Ot = 'pointer-bg-hover',
    Bt = 'pointer-bg-focus',
    Ft = 'pointer-shadow',
    Nt = 'pointer-shadow-hover',
    Vt = 'pointer-shadow-focus',
    Ut = 'pointer-border',
    zt = 'pointer-border-hover',
    Wt = 'pointer-border-focus',
    Te = 'animate-onclick',
    Kt = 'css-links'
  var I = 'vertical',
    V = 'horizontal'
  var we = (r, i, t, n, s) => {
      let d = i - r
      return d === 0 ? t : ((n - t) * (s - r)) / d + t
    },
    B = (r) => !isNaN(parseFloat(r)) && isFinite(r),
    E = (r, i) => (B(r) ? Number(r) : i),
    Qe = (r, i) => (i === 0 ? 0 : Math.round(r / i) * i),
    jt = (r, i = 1 / 0) => {
      if (i === 1 / 0) return r
      let t = Et(10, i)
      return Math.round(r * t) / t
    },
    D = (r) => (r == null ? !1 : typeof r == 'boolean' ? r : r.trim().toLowerCase() === 'true')
  var qt = (r, i) => {
      r.dispatchEvent(new CustomEvent('onPointerClicked', { detail: { $pointer: i } }))
    },
    Xt = (r, i) => {
      r.dispatchEvent(new CustomEvent('onMouseDown', { detail: { nativeEvent: i } }))
    },
    Gt = (r, i) => {
      r.dispatchEvent(new CustomEvent('onMouseUp', { detail: { nativeEvent: i } }))
    },
    Yt = (r, i) => {
      r.dispatchEvent(new CustomEvent('onKeyDown', { detail: { nativeEvent: i } }))
    },
    Zt = (r, i) => {
      if (!i || i.length <= 0) return
      let t = i.map((s) => (B(s) ? E(s, s) : s)),
        n = { values: t || [] }
      ;(n.value = t[0]), (n.value0 = t[0]), (n.value1 = t[0])
      for (let s = 1; s < t.length; s++) n[`value${s + 1}`] = t[s]
      r.dispatchEvent(new CustomEvent('change', { detail: n }))
    }
  var Y = (r, i, t) => {
    let n = 0,
      s,
      d,
      m,
      l,
      a = !1,
      f = (g, S, L, P, A, k) => {
        let F = n
        L !== void 0 && g > L && (g = L), S !== void 0 && g < S && (g = S), (n = g)
        let R = n
        return ((P === I && k) || (P === V && A)) && (R = 100 - R), P === I ? (i.style.top = `${R}%`) : (i.style.left = `${R}%`), F !== n
      },
      x = (g) => g === i || i.contains(g),
      p = (g, S, L, P) => {
        ;(s = g), (d = S), (m = L), (l = P)
      },
      b = (g) => {
        ;(a = g), i.classList.toggle('disabled', a), a ? i.setAttribute('aria-disabled', 'true') : i.hasAttribute('aria-disabled') && i.removeAttribute('aria-disabled')
      },
      T = (g, S) => {
        S == null ? i.removeAttribute(g) : i.setAttribute(g, S)
      },
      C = (g) => i.getAttribute(g),
      c = (g) => {
        if (!a) {
          switch (g.key) {
            case 'ArrowLeft': {
              g.preventDefault(), typeof s == 'function' && s(t)
              break
            }
            case 'ArrowRight': {
              g.preventDefault(), typeof d == 'function' && d(t)
              break
            }
            case 'ArrowUp': {
              g.preventDefault(), typeof m == 'function' && m(t)
              break
            }
            case 'ArrowDown': {
              g.preventDefault(), typeof l == 'function' && l(t)
              break
            }
          }
          Yt(r, g)
        }
      },
      h = () => {
        a || qt(r, i)
      }
    return (
      (i.className = `pointer pointer-${t}`),
      i.addEventListener('keydown', c),
      i.addEventListener('click', h),
      {
        $pointer: i,
        get percent() {
          return n
        },
        get disabled() {
          return a
        },
        set disabled(g) {
          b(g)
        },
        updatePosition: f,
        isClicked: x,
        setCallbacks: p,
        setAttr: T,
        getAttr: C,
        destroy: () => {
          i.removeEventListener('keydown', c), i.removeEventListener('click', h), i.remove()
        }
      }
    )
  }
  var Jt = (r) => {
      if (r == null) return
      if (Array.isArray(r)) return r
      if (r.trim() === '') return
      let t = r.split(','),
        n = [],
        s = !0
      for (let d = 0; d < t.length; d++) {
        let m = t[d].trim()
        m !== '' && (n.push(m), B(m) || (s = !1))
      }
      return s ? n.map((d) => Number(d)) : n
    },
    Qt = (r, i) => (i ? i.findIndex((t) => t === r || t.toString().trim() === r.toString().trim()) : -1)
  var _t = (r) => ({
    updatePosition: (t, n, s, d) => {
      if (n.length <= 0) return
      let m = n.length === 1,
        l = n[0],
        a = n[n.length - 1]
      t === I
        ? (r.style.removeProperty('width'),
          r.style.removeProperty('right'),
          r.style.removeProperty('left'),
          m ? (r.style.height = `${l}%`) : (r.style.height = `${Math.abs(l - a)}%`),
          d ? ((r.style.bottom = '0%'), m ? (r.style.top = 'auto') : (r.style.top = `${Math.min(100 - a, 100 - l)}%`)) : ((r.style.bottom = 'auto'), m ? (r.style.top = '0%') : (r.style.top = `${Math.min(l, a)}%`)))
        : (r.style.removeProperty('height'),
          r.style.removeProperty('top'),
          r.style.removeProperty('bottom'),
          m ? (r.style.width = `${l}%`) : (r.style.width = `${Math.abs(l - a)}%`),
          s ? ((r.style.right = '0%'), m ? (r.style.left = 'auto') : (r.style.left = `${Math.min(100 - a, 100 - l)}%`)) : ((r.style.right = 'auto'), m ? (r.style.left = '0%') : (r.style.left = `${Math.min(l, a)}%`)))
    }
  })
  var _e = '--animate-onclick',
    $t = '--width',
    en = '--height',
    tn = '--panel-bg-border-radius',
    nn = '--panel-bg',
    rn = '--panel-bg-hover',
    on = '--panel-bg-fill',
    sn = '--pointer-width',
    an = '--pointer-height',
    ln = '--pointer-border-radius',
    un = '--pointer-bg',
    dn = '--pointer-bg-hover',
    cn = '--pointer-bg-focus',
    pn = '--pointer-shadow',
    bn = '--pointer-shadow-hover',
    gn = '--pointer-shadow-focus',
    fn = '--pointer-border',
    mn = '--pointer-border-hover',
    hn = '--pointer-border-focus'
  var q = (r, i, t) => {
      let n = new Map()
      for (let s of r.attributes) {
        let d = s.nodeName.trim().toLowerCase()
        if (!i.test(d)) continue
        let l = d.replace(/\D/g, '').trim(),
          a = l === '' || l === '0' || l === '1' ? 0 : E(l, 0) - 1,
          f = t && typeof t == 'function' ? t(s.value) : s.value
        n.set(a, f)
      }
      return n
    },
    yn = (r) => {
      if (!r) return null
      let i = r.getAttribute(Kt)
      if (!i) return null
      let t = i.split(';'),
        n = []
      for (let s of t) s.trim() !== '' && n.push(s.trim())
      return n
    }
  var $e = [
      [$t, At, 'sliderWidth', null],
      [en, Mt, 'sliderHeight', null],
      [tn, wt, 'sliderRadius', null],
      [nn, Dt, 'sliderBg', null],
      [rn, Lt, 'sliderBgHover', null],
      [on, Ct, 'sliderBgFill', null],
      [sn, kt, 'pointer#Width', /^pointer([0-9]*)-width$/],
      [an, Ht, 'pointer#Height', /^pointer([0-9]*)-height$/],
      [ln, It, 'pointer#Radius', /^pointer([0-9]*)-radius$/],
      [un, Rt, 'pointer#Bg', /^pointer([0-9]*)-bg$/],
      [dn, Ot, 'pointer#BgHover', /^pointer([0-9]*)-bg-hover$/],
      [cn, Bt, 'pointer#BgFocus', /^pointer([0-9]*)-bg-focus$/],
      [pn, Ft, 'pointer#Shadow', /^pointer([0-9]*)-shadow$/],
      [bn, Nt, 'pointer#ShadowHover', /^pointer([0-9]*)-shadow-hover$/],
      [gn, Vt, 'pointer#ShadowFocus', /^pointer([0-9]*)-shadow-focus$/],
      [fn, Ut, 'pointer#Border', /^pointer([0-9]*)-border$/],
      [mn, zt, 'pointer#BorderHover', /^pointer([0-9]*)-border-hover$/],
      [hn, Wt, 'pointer#BorderFocus', /^pointer([0-9]*)-border-focus$/]
    ],
    xn = (r, i, t) => {
      let n = null,
        s = [],
        d = new Map(),
        m = (c, h = i) => {
          let w = [...h.classList]
          for (let g of w) g.startsWith(c) && i.classList.remove(g)
        },
        l = () => {
          m('shape')
          let c = i.querySelectorAll('.pointer')
          for (let h of c) m('shape', h)
        },
        a = (c) => {
          ;(n = c), m('theme-'), typeof c == 'string' && i.classList.add(`theme-${c}`)
        },
        f = () => {
          if ((l(), !(s.length <= 0))) {
            i.classList.add('shape', `shape-${s[0]}`)
            for (let c = 1; c < s.length; c++) {
              let h = s[c]
              if (!h) continue
              let w = i.querySelector(`.pointer-${c}`)
              !w || w.classList.add('shape', `shape-${h}`)
            }
          }
        },
        x = (c, h) => {
          ;(s[c] = h), f()
        },
        p = () => {
          l()
          let c = q(r, /^pointer([0-9]*)-shape$/)
          if (!(c.size <= 0)) {
            for (let h of c) {
              let w = h[0]
              s[w] = h[1]
            }
            f()
          }
        },
        b = (c, h) => `${c}-${h}`,
        T = (c, h, w) => {
          let g = t[w]
          if (!g) return
          let S = w === 0 ? i : g.$pointer
          if (h == null) {
            d.has(b(c, w)) && d.delete(b(c, w)), S.style.removeProperty(c)
            return
          }
          d.set(b(c, w), h), S.style.setProperty(c, h)
        },
        C = (c, h) => d.get(b(c, h))
      return (
        (() => {
          for (let c of $e) {
            let [h, w, g, S] = c
            if (S) {
              let P = q(r, S)
              for (let A of P) {
                let k = A[0],
                  F = A[1]
                T(h, F, k)
              }
            } else {
              let P = r.getAttribute(w)
              T(h, P, 0)
            }
            let L = []
            if (g.indexOf('#') === -1) L.push([g, 0])
            else {
              L.push([g.replace('#', ''), 0]), L.push([g.replace('#', '0'), 0]), L.push([g.replace('#', '1'), 0])
              for (let P = 1; P < t.length; P++) L.push([g.replace('#', (P + 1).toString()), P])
            }
            for (let P of L)
              try {
                let A = P[0],
                  k = P[1]
                Object.prototype.hasOwnProperty.call(r, A) ||
                  Object.defineProperty(r, A, {
                    get() {
                      return C(h, k)
                    },
                    set: (F) => {
                      T(h, F, k)
                    }
                  })
              } catch (A) {
                console.error(A)
              }
          }
          a(r.getAttribute(ve)), p()
        })(),
        {
          setStyle: T,
          getStyle: C,
          get theme() {
            return n
          },
          set theme(c) {
            a(c)
          },
          get pointerShapes() {
            return s
          },
          setPointerShape: x
        }
      )
    }
  var K = 'animate-on-click',
    et = 'range-dragging'
  var Pn = (r, i, t, n) => {
    let s = [],
      d = (p) => {
        for (let b of s) b.update && typeof b.update == 'function' && b.update(p)
      },
      m = () => {
        for (let p of s) p.destroy && typeof p.destroy == 'function' && p.destroy()
      },
      l = (p, b) => {
        for (let T of s) T.onAttrChange && typeof T.onAttrChange == 'function' && T.onAttrChange(p, b)
      },
      a = (p) => {
        if (!!p.gettersAndSetters) {
          for (let b of p.gettersAndSetters)
            if (!(!b.name || !b.attributes))
              try {
                Object.prototype.hasOwnProperty.call(r, b.name) || Object.defineProperty(r, b.name, b.attributes)
              } catch (T) {
                console.error('defineSettersGetters error:', T)
              }
        }
      },
      f = (p) => {
        var T
        if (!p.css) return
        let b = (T = r.shadowRoot) == null ? void 0 : T.querySelector('style')
        !b || (b.innerHTML += p.css)
      }
    return {
      init: () => {
        if (!!window.tcRangeSliderPlugins)
          for (let p of window.tcRangeSliderPlugins) {
            let b = p()
            s.push(b), b.init && typeof b.init == 'function' && (b.init(r, i, t, n), a(b), f(b))
          }
      },
      update: d,
      onAttrChange: l,
      destroy: m
    }
  }
  var Yn = 10,
    En = 20,
    Sn = (r, i) => {
      let t = new Map(),
        n = /^value([0-9]*)$/
      for (let l of r.attributes) {
        let a = l.nodeName.trim().toLowerCase()
        if (!n.test(a)) continue
        let x = a.replace('value', '').trim(),
          p = x === '' || x === '0' || x === '1' ? 0 : E(x, 0) - 1,
          b = B(l.value) ? E(l.value, 0) : l.value
        t.set(p, b)
      }
      let s = Math.max(...Array.from(t.keys())),
        d = []
      d.push([Y(r, i, 0), t.get(0)])
      let m = i
      for (let l = 1; l <= s; l++) {
        let a = i.cloneNode(!0)
        m.after(a), (m = a), d.push([Y(r, a, l), t.get(l)])
      }
      return d
    },
    tt = (r, i, t, n, s, d, m) => {
      try {
        Object.defineProperty(r, n, {
          configurable: !0,
          get() {
            if (!i) return
            let l = i.pointers[t]
            if (!l) return
            let a = i.getTextValue(l.percent)
            return B(a) ? E(a, a) : a
          },
          set: (l) => {
            i.pointers[t] ? i == null || i.setValue(l, t) : i == null || i.addPointer(l)
          }
        }),
          Object.defineProperty(r, s, {
            configurable: !0,
            get() {
              var l, a
              return (a = (l = i == null ? void 0 : i.pointers[t]) == null ? void 0 : l.getAttr('aria-label')) != null ? a : void 0
            },
            set: (l) => {
              !i || i.setAriaLabel(t, l)
            }
          }),
          Object.defineProperty(r, d, {
            configurable: !0,
            get() {
              var l, a
              return (a = (l = i == null ? void 0 : i.styles) == null ? void 0 : l.pointerShapes[t]) != null ? a : null
            },
            set: (l) => {
              !i || !i.styles || i.styles.setPointerShape(t, l)
            }
          }),
          Object.defineProperty(r, m, {
            configurable: !0,
            get() {
              var l
              return (l = i == null ? void 0 : i.pointers[t].disabled) != null ? l : !1
            },
            set: (l) => {
              if (!i) return
              let a = i == null ? void 0 : i.pointers[t]
              !a || (a.disabled = l)
            }
          })
      } catch (l) {
        console.error(l)
      }
    },
    Tn = (r, i) => {
      let t = [
        ['value', 'ariaLabel', 'pointerShape', 'pointerDisabled', 0],
        ['value0', 'ariaLabel0', 'pointerShape0', 'pointer0Disabled', 0],
        ['value1', 'ariaLabel1', 'pointerShape1', 'pointer1Disabled', 0]
      ]
      for (let n = 2; n < Yn; n++) t.push([`value${n}`, `ariaLabel${n}`, `pointer${n}Shape`, `pointer${n}Disabled`, n - 1])
      for (let n of t) tt(r, i, n[4], n[0], n[1], n[2], n[3])
    },
    nt = (r, i, t) => {
      var s
      let n = (s = t.shadowRoot) == null ? void 0 : s.querySelector('.container')
      if (!!n) for (let d of r) i ? n.prepend(d.$pointer) : n.append(d.$pointer)
    },
    An = (r, i) => {
      if (!(!i || r.length <= 1)) {
        for (let t of r) t.$pointer.style.zIndex = En.toString()
        i.$pointer.style.zIndex = (En * 2).toString()
      }
    }
  var rt = 0,
    Z = 100,
    U = 2,
    Mn = '0.3s',
    wn = (r, i, t) => {
      let n = t.map((e) => e[0]),
        s = null,
        d = null,
        m = null,
        l = null,
        a = rt,
        f = Z,
        x,
        p,
        b = V,
        T = U,
        C = !1,
        c = !1,
        h = !1,
        w = 0,
        g = 1 / 0,
        S = !1,
        L,
        P,
        A = !1,
        k = !1,
        F = !1,
        R = Mn,
        ot = [],
        st = (e) => {
          A || (e.preventDefault && e.preventDefault(), z(e), window.addEventListener('mousemove', z), window.addEventListener('mouseup', J), Xt(r, e))
        },
        J = (e) => {
          A || ((L = void 0), (P = void 0), window.removeEventListener('mousemove', z), window.removeEventListener('mouseup', J), R && i.classList.add(K), Gt(r, e))
        },
        Ln = (e, o) => {
          if (n.length <= 0) return
          if (n.length === 1) return n[0].isClicked(e) && R && i.classList.remove(K), n[0]
          let u = kn(e)
          if (S) {
            let v = o,
              O = _(v)
            O !== void 0 && (v = Qe(v, O)), u ? ((L = v), (P = 0), R && i.classList.remove(K)) : L !== void 0 && ((P = v - L), (L = v))
          }
          if (!Cn(e) && !u) {
            for (let v of n) if (!(!v.isClicked(e) || v.disabled)) return R && i.classList.remove(K), v
            for (let v of n) if (s === v) return v
          }
          let y = 1 / 0,
            M = null
          for (let v of n) {
            if (v.disabled) continue
            let O = Math.abs(o - v.percent)
            O < y && ((y = O), (M = v))
          }
          return M
        },
        at = () => n.findIndex((e) => s === e && !e.disabled),
        z = (e) => {
          let o
          if (b === I) {
            let { height: y, top: M } = i.getBoundingClientRect(),
              v = e.type.indexOf('mouse') !== -1 ? e.clientY : e.touches[0].clientY
            o = (Math.min(Math.max(0, v - M), y) * 100) / y
          } else {
            let { width: y, left: M } = i.getBoundingClientRect(),
              v = e.type.indexOf('mouse') !== -1 ? e.clientX : e.touches[0].clientX
            o = (Math.min(Math.max(0, v - M), y) * 100) / y
          }
          if (((C || c) && (o = 100 - o), (s = Ln(e.target, o)), s && An(n, s), S && n.length > 1 && P !== void 0)) {
            let y = n[0],
              M = n[n.length - 1],
              v = y.percent + P < 0,
              O = M.percent + P > 100
            if (v || O) return
            for (let se = 0; se < n.length; se++) H(se, n[se].percent + P)
            return
          }
          let u = at()
          u !== -1 && (H(u, o), s == null || s.$pointer.focus())
        },
        Q = (e) => {
          if (A || document.activeElement !== r || (s == null ? void 0 : s.disabled)) return
          e.stopPropagation(), e.preventDefault()
          let o = e.deltaY < 0,
            u = C || c,
            y = o ? !u : u,
            M = at()
          M !== -1 && (y ? X(M, n[M].percent) : G(M, n[M].percent))
        },
        lt = (e) => {
          A || k || (b === I ? (c ? H(e, 100) : H(e, 0)) : C ? G(e, n[e].percent) : X(e, n[e].percent))
        },
        ut = (e) => {
          A || k || (b === I ? (c ? H(e, 0) : H(e, 100)) : C ? X(e, n[e].percent) : G(e, n[e].percent))
        },
        dt = (e) => {
          A || k || (b === I ? (c ? G(e, n[e].percent) : X(e, n[e].percent)) : C ? H(e, 100) : H(e, 0))
        },
        ct = (e) => {
          A || k || (b === I ? (c ? X(e, n[e].percent) : G(e, n[e].percent)) : C ? H(e, 0) : H(e, 100))
        },
        Cn = (e) => e.classList.contains('panel'),
        kn = (e) => e.classList.contains('panel-fill'),
        X = (e, o) => {
          if (o === void 0) return
          let u = _(o)
          u == null && (u = 1), (o -= u), o < 0 && (o = 0), H(e, o)
        },
        G = (e, o) => {
          if (o === void 0) return
          let u = _(o)
          u == null && (u = 1), (o += u), o > 100 && (o = 100), H(e, o)
        },
        W = () => {
          !l ||
            l.update({
              percents: pt(),
              values: bt(),
              $pointers: gt(),
              min: ft(),
              max: mt(),
              data: Ce(),
              step: Le(),
              round: He(),
              type: ke(),
              textMin: $(),
              textMax: ee(),
              rightToLeft: Oe(),
              bottomToTop: Be(),
              pointersOverlap: Ue(),
              pointersMinDistance: Ie(),
              pointersMaxDistance: Re(),
              rangeDragging: ze(),
              disabled: Fe(),
              keyboardDisabled: Ne(),
              mousewheelDisabled: Ve()
            })
        },
        Hn = () => {
          W()
        },
        In = (e) => {
          if (!(h || n.length <= 1 || f === a))
            if (e === 0) {
              let o = (g * 100) / (f - a)
              return Math.max(0, n[e + 1].percent - o)
            } else {
              let o = (w * 100) / (f - a)
              return Math.min(n[e - 1].percent + o, 100)
            }
        },
        Rn = (e) => {
          if (!(h || n.length <= 1 || f === a))
            if (e === n.length - 1) {
              let o = (g * 100) / (f - a)
              return Math.min(n[e - 1].percent + o, 100)
            } else {
              let o = (w * 100) / (f - a)
              return Math.max(0, n[e + 1].percent - o)
            }
        },
        _ = (e) => {
          let o
          if (typeof x == 'function') {
            let u = we(0, 100, a, f, e)
            o = x(u, e)
          } else o = x
          if (B(o)) {
            let u = f - a
            return (o = u === 0 ? 0 : (o * 100) / u), o
          }
        },
        j = (e) => {
          if (e === void 0) return
          let o = we(0, 100, a, f, e)
          return p !== void 0 ? p[Math.round(o)] : jt(o, T)
        },
        $ = () => (p !== void 0 ? p[a] : a),
        ee = () => (p !== void 0 ? p[f] : f),
        Le = () => x,
        On = (e) => {
          var o
          return e <= 0 || h ? $() : (o = j(n[e - 1].percent)) != null ? o : ''
        },
        Bn = (e) => {
          var o
          return n.length <= 1 || e >= n.length - 1 || h ? ee() : (o = j(n[e + 1].percent)) != null ? o : ''
        },
        pt = () => n.map((e) => e.percent),
        bt = () => n.map((e) => j(e.percent)),
        gt = () => n.map((e) => e.$pointer),
        ft = () => a,
        mt = () => f,
        Ce = () => p,
        ke = () => b,
        He = () => T,
        Ie = () => w,
        Re = () => g,
        Fn = (e) => ot[e],
        Oe = () => C,
        Be = () => c,
        Fe = () => A,
        Ne = () => k,
        Ve = () => F,
        Ue = () => h,
        ze = () => S,
        H = (e, o) => {
          if (o === void 0) return
          let u = _(o)
          u !== void 0 && (o = Qe(o, u))
          let y = n[e]
          if (!y) return
          let M = y.updatePosition(o, In(e), Rn(e), b, C, c)
          d == null ||
            d.updatePosition(
              b,
              n.map((v) => v.percent),
              C,
              c
            ),
            W()
          for (let v of n) {
            let O = j(v.percent)
            O !== void 0 && (v.setAttr('aria-valuenow', O.toString()), v.setAttr('aria-valuetext', O.toString()))
          }
          Vn(),
            M &&
              Zt(
                r,
                n.map((v) => j(v.percent))
              )
        },
        N = () => {
          for (let e = 0; e < n.length; e++) H(e, n[e].percent)
        },
        Nn = (e, o) => {
          ;(a = p !== void 0 ? 0 : E(e, rt)), (f = p !== void 0 ? p.length - 1 : E(o, Z)), te(a), ne(f)
        },
        Vn = () => {
          var e, o
          for (let u = 0; u < n.length; u++) {
            let y = n[u]
            y.setAttr('aria-valuemin', ((e = On(u)) != null ? e : '').toString()), y.setAttr('aria-valuemax', ((o = Bn(u)) != null ? o : '').toString())
          }
        },
        te = (e) => {
          ;(a = E(e, rt)), a > f && (f = a + Z), N()
        },
        ne = (e) => {
          ;(f = E(e, Z)), f < a && (f = a + Z), N()
        },
        ht = (e) => {
          h = !0
          for (let o = 0; o < e.length; o++) re(e[o], o)
          h = !1
          for (let o = 0; o < e.length; o++) re(e[o], o)
        },
        re = (e, o) => {
          let u
          p !== void 0 ? ((u = e == null ? 0 : Qt(e, p)), u === -1 && (u = 0)) : ((u = E(e, a)), u < a && (u = a), u > f && (u = f))
          let y = we(a, f, 0, 100, u)
          H(o, y)
        },
        ie = (e) => {
          if (e == null) {
            x = void 0
            return
          }
          if (typeof e == 'function') {
            ;(x = e), N()
            return
          }
          if (B(e)) {
            x = E(e, 1)
            let o = Math.abs(f - a)
            x > o && (x = void 0), N()
            return
          }
          x = void 0
        },
        We = (e) => {
          ;(h = e), N()
        },
        Ke = (e) => {
          ;(!B(e) || e < 0) && (e = 0), (w = e)
        },
        je = (e) => {
          ;(!B(e) || e < 0) && (e = 1 / 0), (g = e)
        },
        qe = (e) => {
          ;(A = e), i.classList.toggle('disabled', A), A ? i.setAttribute('aria-disabled', 'true') : i.hasAttribute('aria-disabled') && i.removeAttribute('aria-disabled')
        },
        vt = (e) => {
          k = e
        },
        yt = (e) => {
          ;(F = e), F ? document.removeEventListener('wheel', Q) : document.addEventListener('wheel', Q, { passive: !1 })
        },
        Xe = (e) => {
          if (e == null) {
            p = void 0
            return
          }
          if (((p = Jt(e)), p === void 0 || p.length <= 0)) {
            p = void 0
            return
          }
          te(0), ne(p.length - 1), x === void 0 && ie(1)
        },
        Ge = (e) => {
          var y
          typeof e == 'string' ? (b = e.trim().toLowerCase() === I ? I : V) : (b = V)
          let o = (y = r.shadowRoot) == null ? void 0 : y.querySelector('.range-slider-box')
          if (!o) return
          ;(o.className = `range-slider-box type-${b}`), N()
          let u = b === I ? 'vertical' : 'horizontal'
          for (let M of n) M.setAttr('aria-orientation', u)
        },
        Ye = (e) => {
          ;(C = e), n.length > 1 && nt(n, C, r), N(), W()
        },
        Ze = (e) => {
          ;(c = e), n.length > 1 && nt(n, c, r), N(), W()
        },
        Je = (e) => {
          ;(T = E(e, U)), T < 0 && (T = U), W()
        },
        xt = (e) => {
          e == null || e.toString().trim().toLowerCase() === 'false' ? ((R = void 0), i.style.removeProperty(_e), i.classList.remove(K)) : ((R = e.toString()), i.style.setProperty(_e, R), i.classList.add(K))
        },
        Pt = (e, o) => {
          let u = n[e]
          !u || (u.setAttr('aria-label', o), (ot[e] = o))
        },
        oe = (e) => {
          if (((L = void 0), n.length <= 1)) {
            ;(S = !1), i.classList.remove(et)
            return
          }
          ;(S = e), i.classList.toggle(et, S)
        },
        Un = () => {
          qe(D(r.getAttribute(Pe))), (k = D(r.getAttribute(Ee))), (F = D(r.getAttribute(Se)))
          let e = q(r, /^pointer([0-9]*)-disabled$/, (o) => D(o))
          for (let o of e) {
            let u = o[0]
            !n[u] || (n[u].disabled = o[1])
          }
        },
        zn = () => {
          let e = q(r, /^aria-label([0-9]*)$/)
          for (let o of e) {
            let u = o[0]
            Pt(u, o[1])
          }
        },
        Wn = (e) => {
          let o = n.length,
            u = n[o - 1].$pointer,
            y = u.cloneNode(!0)
          u.after(y)
          let M = Y(r, y, o)
          return M.setCallbacks(lt, ut, dt, ct), n.push(M), re(e, o), N(), W(), o
        },
        Kn = () => {
          let e = n.length,
            o = n[e - 1]
          return o ? (o.destroy(), n.pop(), n.length <= 1 && oe(!1), N(), W(), e - 1) : -1
        }
      return (
        (() => {
          var o, u
          for (let y of n) y.setCallbacks(lt, ut, dt, ct)
          let e = (o = r.shadowRoot) == null ? void 0 : o.querySelector('.panel-fill')
          e && (d = _t(e)),
            Ge(r.getAttribute(he)),
            Ye(D(r.getAttribute(ye))),
            Ze(D(r.getAttribute(xe))),
            Nn(r.getAttribute(be), r.getAttribute(ge)),
            ie(r.getAttribute(fe)),
            Xe(r.getAttribute(pe)),
            ht(t.map((y) => y[1])),
            We(D(r.getAttribute(le))),
            Ke(E(r.getAttribute(ue), 0)),
            je(E(r.getAttribute(de), 1 / 0)),
            oe(D(r.getAttribute(ce))),
            Je(E(r.getAttribute(me), U)),
            Un(),
            zn(),
            (m = xn(r, i, n)),
            xt((u = r.getAttribute(Te)) != null ? u : Mn),
            i.addEventListener('mousedown', st),
            i.addEventListener('mouseup', J),
            i.addEventListener('touchmove', z),
            i.addEventListener('touchstart', z),
            F || document.addEventListener('wheel', Q, { passive: !1 }),
            (l = Pn(
              r,
              Hn,
              {
                setValues: ht,
                setMin: te,
                setMax: ne,
                setStep: ie,
                setPointersOverlap: We,
                setPointersMinDistance: Ke,
                setPointersMaxDistance: je,
                setDisabled: qe,
                setType: Ge,
                setRightToLeft: Ye,
                setBottomToTop: Ze,
                setRound: Je,
                setKeyboardDisabled: vt,
                setMousewheelDisabled: yt,
                setRangeDragging: oe,
                setData: Xe
              },
              {
                getPercents: pt,
                getValues: bt,
                getPointerElements: gt,
                getMin: ft,
                getMax: mt,
                getStep: Le,
                getData: Ce,
                getType: ke,
                getRound: He,
                getTextMin: $,
                getTextMax: ee,
                isRightToLeft: Oe,
                isBottomToTop: Be,
                isDisabled: Fe,
                isKeyboardDisabled: Ne,
                isMousewheelDisabled: Ve,
                isPointersOverlap: Ue,
                isRangeDraggingEnabled: ze,
                getPointersMinDistance: Ie,
                getPointersMaxDistance: Re
              }
            )),
            l.init()
        })(),
        {
          get pointers() {
            return n
          },
          get styles() {
            return m
          },
          get pluginsManager() {
            return l
          },
          get min() {
            return $()
          },
          get max() {
            return ee()
          },
          get step() {
            return Le()
          },
          get pointersOverlap() {
            return Ue()
          },
          set pointersOverlap(e) {
            We(e)
          },
          get pointersMinDistance() {
            return Ie()
          },
          set pointersMinDistance(e) {
            Ke(e)
          },
          get pointersMaxDistance() {
            return Re()
          },
          set pointersMaxDistance(e) {
            je(e)
          },
          get disabled() {
            return Fe()
          },
          set disabled(e) {
            qe(e)
          },
          get data() {
            return Ce()
          },
          get type() {
            return ke()
          },
          set type(e) {
            Ge(e)
          },
          get rightToLeft() {
            return Oe()
          },
          set rightToLeft(e) {
            Ye(e)
          },
          get bottomToTop() {
            return Be()
          },
          set bottomToTop(e) {
            Ze(e)
          },
          get round() {
            return He()
          },
          set round(e) {
            Je(e)
          },
          get animateOnClick() {
            return R
          },
          set animateOnClick(e) {
            xt(e)
          },
          get keyboardDisabled() {
            return Ne()
          },
          set keyboardDisabled(e) {
            vt(e)
          },
          get mousewheelDisabled() {
            return Ve()
          },
          set mousewheelDisabled(e) {
            yt(e)
          },
          get rangeDragging() {
            return ze()
          },
          set rangeDragging(e) {
            oe(e)
          },
          setMin: te,
          setMax: ne,
          setValue: re,
          setStep: ie,
          setData: Xe,
          getTextValue: j,
          setAriaLabel: Pt,
          getAriaLabel: Fn,
          addPointer: Wn,
          removePointer: Kn,
          destroy: () => {
            i.removeEventListener('mousedown', st), i.removeEventListener('mouseup', J), i.removeEventListener('touchmove', z), i.removeEventListener('touchstart', z), document.removeEventListener('wheel', Q)
            for (let e of n) e.destroy()
            l == null || l.destroy()
          }
        }
      )
    }
  var Dn = (r, i, t) => {
    let n = $e.find(([l, a, f, x]) => a.replace('#', '') === i.replace(/\d+/g, ''))
    if (n && r.styles) {
      let [l, a, f, x] = n,
        p = i.replace(/\D/g, '').trim(),
        b = p === '' || p === '0' || p === '1' ? 0 : E(p, 0) - 1
      r.styles.setStyle(l, t, b)
      return
    }
    switch ((r && r.pluginsManager && r.pluginsManager.onAttrChange(i, t), i)) {
      case be: {
        r.setMin(t)
        break
      }
      case ge: {
        r.setMax(t)
        break
      }
      case fe: {
        r.setStep(t)
        break
      }
      case le: {
        r.pointersOverlap = D(t)
        break
      }
      case ue: {
        r.pointersMinDistance = E(t, 0)
        break
      }
      case ce: {
        r.rangeDragging = D(t)
        break
      }
      case de: {
        r.pointersMaxDistance = E(t, 1 / 0)
        break
      }
      case Pe: {
        r.disabled = D(t)
        break
      }
      case Ee: {
        r.keyboardDisabled = D(t)
        break
      }
      case Se: {
        r.mousewheelDisabled = D(t)
        break
      }
      case pe: {
        r.setData(t)
        break
      }
      case he: {
        r.type = t
        break
      }
      case ye: {
        r.rightToLeft = D(t)
        break
      }
      case xe: {
        r.bottomToTop = D(t)
        break
      }
      case me: {
        r.round = E(t, U)
        break
      }
      case ve: {
        r.styles && (r.styles.theme = t)
        break
      }
      case Te: {
        r.animateOnClick = t
        break
      }
    }
    let s = null
    if ((/^value([0-9]*)$/.test(i) && (s = 'value'), /^pointer([0-9]*)-disabled$/.test(i) && (s = 'pointer-disabled'), /^aria-label([0-9]*)$/.test(i) && (s = 'aria-label'), /^pointer([0-9]*)-shape$/.test(i) && (s = 'pointer-shape'), !s)) return
    let d = i.replace(/\D/g, '').trim(),
      m = d === '' || d === '0' || d === '1' ? 0 : E(d, 0) - 1
    switch (s) {
      case 'value': {
        r.setValue(t, m)
        break
      }
      case 'pointer-disabled': {
        let l = r == null ? void 0 : r.pointers[m]
        if (!l) return
        l.disabled = D(t)
        break
      }
      case 'aria-label': {
        r.setAriaLabel(m, t)
        break
      }
      case 'pointer-shape': {
        r.styles && r.styles.setPointerShape(m, t)
        break
      }
    }
  }
  var it = class extends HTMLElement {
      constructor() {
        super()
        ae(this, 'slider')
        ae(this, '_externalCSSList', [])
        ae(this, '_observer', null)
        this.attachShadow({ mode: 'open' })
      }
      set step(t) {
        this.slider && this.slider.setStep(t)
      }
      get step() {
        var t
        return (t = this.slider) == null ? void 0 : t.step
      }
      set disabled(t) {
        this.slider && (this.slider.disabled = t)
      }
      get disabled() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.disabled) != null ? n : !1
      }
      set data(t) {
        var n
        ;(n = this.slider) == null || n.setData(t)
      }
      get data() {
        var t
        return (t = this.slider) == null ? void 0 : t.data
      }
      set min(t) {
        var n
        ;(n = this.slider) == null || n.setMin(t)
      }
      get min() {
        var t
        return (t = this.slider) == null ? void 0 : t.min
      }
      set max(t) {
        var n
        ;(n = this.slider) == null || n.setMax(t)
      }
      get max() {
        var t
        return (t = this.slider) == null ? void 0 : t.max
      }
      set round(t) {
        !this.slider || (this.slider.round = t)
      }
      get round() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.round) != null ? n : U
      }
      set type(t) {
        !this.slider || (this.slider.type = t != null ? t : V)
      }
      get type() {
        var t
        return ((t = this.slider) == null ? void 0 : t.type) || V
      }
      set pointersOverlap(t) {
        !this.slider || (this.slider.pointersOverlap = t)
      }
      get pointersOverlap() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.pointersOverlap) != null ? n : !1
      }
      set pointersMinDistance(t) {
        !this.slider || (this.slider.pointersMinDistance = t)
      }
      get pointersMinDistance() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.pointersMinDistance) != null ? n : 0
      }
      set pointersMaxDistance(t) {
        !this.slider || (this.slider.pointersMaxDistance = t)
      }
      get pointersMaxDistance() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.pointersMaxDistance) != null ? n : 1 / 0
      }
      set theme(t) {
        !this.slider || !this.slider.styles || (this.slider.styles.theme = t)
      }
      get theme() {
        var t, n, s
        return (s = (n = (t = this.slider) == null ? void 0 : t.styles) == null ? void 0 : n.theme) != null ? s : null
      }
      set rtl(t) {
        !this.slider || (this.slider.rightToLeft = t)
      }
      get rtl() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.rightToLeft) != null ? n : !1
      }
      set btt(t) {
        !this.slider || (this.slider.bottomToTop = t)
      }
      get btt() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.bottomToTop) != null ? n : !1
      }
      set keyboardDisabled(t) {
        !this.slider || (this.slider.keyboardDisabled = t)
      }
      get keyboardDisabled() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.keyboardDisabled) != null ? n : !1
      }
      set mousewheelDisabled(t) {
        !this.slider || (this.slider.mousewheelDisabled = t)
      }
      get mousewheelDisabled() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.mousewheelDisabled) != null ? n : !1
      }
      set animateOnClick(t) {
        !this.slider || (this.slider.animateOnClick = t)
      }
      get animateOnClick() {
        var t
        return (t = this.slider) == null ? void 0 : t.animateOnClick
      }
      get rangeDragging() {
        var t, n
        return (n = (t = this.slider) == null ? void 0 : t.rangeDragging) != null ? n : !1
      }
      set rangeDragging(t) {
        this.slider && (this.slider.rangeDragging = D(t))
      }
      get externalCSSList() {
        return this._externalCSSList
      }
      addPointer(t) {
        var s, d
        if (!this.slider) return
        let n = (d = (s = this.slider) == null ? void 0 : s.addPointer(t)) != null ? d : 0
        tt(this, this.slider, n, `value${n + 1}`, `ariaLabel${n + 1}`, `pointerShape${n + 1}`, `pointer${n + 1}Disabled`)
      }
      removePointer() {
        var t
        !this.slider || (t = this.slider) == null || t.removePointer()
      }
      addCSS(t) {
        if (!this.shadowRoot) return
        let n = document.createElement('style')
        ;(n.textContent = t), this.shadowRoot.appendChild(n)
      }
      connectedCallback() {
        var d, m
        if (!this.shadowRoot) return
        ;(this._externalCSSList = yn(this)), (this.shadowRoot.innerHTML = St(Tt, this._externalCSSList))
        let t = (d = this.shadowRoot) == null ? void 0 : d.querySelector('.pointer')
        if (!t) return
        let n = (m = this.shadowRoot) == null ? void 0 : m.getElementById('range-slider')
        if (!n) return
        let s = Sn(this, t)
        ;(this.slider = wn(this, n, s)),
          Tn(this, this.slider),
          (this._observer = new MutationObserver((l) => {
            l.forEach((a) => {
              var x
              if (!this.slider || a.type !== 'attributes') return
              let f = a.attributeName
              !f || Dn(this.slider, f, (x = this.getAttribute(f)) != null ? x : '')
            })
          })),
          this._observer.observe(this, { attributes: !0 })
      }
      disconnectedCallback() {
        this._observer && this._observer.disconnect(), this.slider && this.slider.destroy()
      }
    },
    De = it
  window.tcRangeSlider = De
  customElements.get('toolcool-range-slider') || customElements.define('toolcool-range-slider', De)
  customElements.get('tc-range-slider') || customElements.define('tc-range-slider', class extends De {})
})()
//# sourceMappingURL=toolcool-range-slider.min.js.map
