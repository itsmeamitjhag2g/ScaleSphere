/* ScaleSphere home — Boulder-style panel opens + float + scramble */
(() => {
  const root = document.querySelector(".ss-home");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const workData = window.__SS_WORK__ || [];
  const hasGsap = !!(window.gsap && window.ScrollTrigger);

  const SCRAMBLE_CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789↘●▀▫►◄■□";

  function scrambleTo(el, finalText, rounds = 10) {
    if (!el || reduce) {
      if (el) el.textContent = finalText;
      return;
    }
    const target = finalText;
    let frame = 0;
    const total = Math.max(rounds, Math.min(18, target.length + 6));
    const tick = () => {
      frame += 1;
      const progress = frame / total;
      let out = "";
      for (let i = 0; i < target.length; i++) {
        if (target[i] === " ") {
          out += " ";
          continue;
        }
        if (i / target.length < progress) out += target[i];
        else out += SCRAMBLE_CHARS[(Math.random() * SCRAMBLE_CHARS.length) | 0];
      }
      el.textContent = out;
      if (frame < total) requestAnimationFrame(tick);
      else el.textContent = target;
    };
    requestAnimationFrame(tick);
  }

  /* Hero: only “Scale” scrambles outside → inside; other words fade in */
  const title = document.querySelector("#ssHeroTitle");
  if (title) {
    const CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    const scrambleOutsideIn = (el, { durationMs = 1400 } = {}) =>
      new Promise((resolve) => {
        const finalText = (el.getAttribute("data-final") || el.textContent || "").trim();
        if (reduce || finalText.length === 0) {
          el.textContent = finalText;
          return resolve();
        }

        const chars = finalText.split("");
        const n = chars.length;
        const order = [];
        let l = 0;
        let r = n - 1;
        while (l <= r) {
          if (l === r) order.push(l);
          else {
            order.push(l);
            order.push(r);
          }
          l += 1;
          r -= 1;
        }

        const resolved = new Set();
        const startAt = performance.now();
        const stepMs = Math.max(90, durationMs / Math.max(order.length, 1));

        const id = setInterval(() => {
          const elapsed = performance.now() - startAt;
          const unlockCount = Math.min(order.length, Math.floor(elapsed / stepMs) + 1);
          for (let i = 0; i < unlockCount; i++) resolved.add(order[i]);

          let out = "";
          for (let i = 0; i < n; i++) {
            if (chars[i] === " ") {
              out += " ";
              continue;
            }
            if (resolved.has(i)) out += chars[i];
            else {
              const pool = chars[i] === chars[i].toLowerCase() ? CHARS.toLowerCase() : CHARS;
              out += pool[(Math.random() * 26) | 0];
            }
          }
          el.textContent = out;

          if (resolved.size >= order.length && elapsed >= durationMs) {
            clearInterval(id);
            el.textContent = finalText;
            resolve();
          }
        }, 36);
      });

    const runHero = async () => {
      const words = [...title.querySelectorAll("[data-hero-word]")];
      const marks = [...title.querySelectorAll("[data-hero-mark]")];
      marks.forEach((m) => {
        m.style.opacity = "0";
        m.style.transform = "scale(0.6)";
      });

      for (const el of words) {
        const finalText = (el.getAttribute("data-final") || "").trim();
        const isScale = el.hasAttribute("data-hero-scale");
        el.style.opacity = "1";
        if (window.gsap) {
          gsap.fromTo(el, { y: 10, opacity: 0 }, { y: 0, opacity: 1, duration: 0.28, ease: "power2.out" });
        }
        if (isScale) {
          el.textContent = finalText.replace(/./g, (c) => (c === " " ? " " : "·"));
          await scrambleOutsideIn(el, { durationMs: reduce ? 0 : 1500 });
        } else {
          el.textContent = finalText;
          await new Promise((r) => setTimeout(r, reduce ? 0 : 70));
        }
      }

      if (window.gsap) {
        gsap.to(marks, { opacity: 1, scale: 1, duration: 0.35, stagger: 0.08, ease: "back.out(1.6)" });
      } else {
        marks.forEach((m) => {
          m.style.opacity = "1";
          m.style.transform = "none";
        });
      }
    };

    title.querySelectorAll("[data-hero-word]").forEach((el) => {
      el.textContent = el.getAttribute("data-final") || el.textContent;
    });
    runHero();
  }

  /* Floating chips — desktop only (perf) */
  if (hasGsap && !reduce && window.innerWidth >= 768) {
    root.querySelectorAll("[data-float-hero],.ss-float").forEach((el, i) => {
      gsap.to(el, {
        y: i % 2 === 0 ? -10 : 12,
        duration: 2.8 + (i % 3) * 0.4,
        yoyo: true,
        repeat: -1,
        ease: "sine.inOut",
        delay: i * 0.1,
      });
    });
  }

  /* Brand: dual doors open center→L/R; scroll back closes same way */
  const revealTrack = document.getElementById("ssRevealTrack");
  const heroEl = document.getElementById("hero");
  const brandPanel = document.getElementById("ssBrandPanel");
  const brandDoors = document.getElementById("ssBrandDoors");
  const doorLeft = brandDoors?.querySelector('[data-brand-door="left"]');
  const doorRight = brandDoors?.querySelector('[data-brand-door="right"]');
  const brandName = brandPanel?.querySelector("[data-brand-name]");
  const brandSub = brandPanel?.querySelector("[data-brand-sub]");
  const brandCopy = brandPanel?.querySelector("[data-brand-copy]");
  const brandSeam = brandDoors?.querySelector("[data-brand-seam]") || brandPanel?.querySelector("[data-brand-seam]");
  const brandChips = brandPanel
    ? [...brandPanel.querySelectorAll("[data-brand-chip]")]
    : [];
  const scrollHint = document.getElementById("ssScrollHint");
  const chipFrom = {
    tl: { x: -36, y: -24 },
    tr: { x: 36, y: -24 },
    bl: { x: -36, y: 24 },
    br: { x: 36, y: 24 },
  };

  if (revealTrack && heroEl && brandPanel && doorLeft && doorRight) {
    if (reduce) {
      doorLeft.style.transform = "scaleX(0)";
      doorRight.style.transform = "scaleX(0)";
      if (brandDoors) brandDoors.style.pointerEvents = "none";
      heroEl.style.opacity = "0";
      [brandName, brandSub, brandCopy, ...brandChips].forEach((el) => {
        if (el) {
          el.style.opacity = "1";
          el.style.transform = "none";
          el.style.filter = "none";
        }
      });
    } else if (hasGsap) {
      gsap.registerPlugin(ScrollTrigger);

      doorLeft.style.transformOrigin = "right center";
      doorRight.style.transformOrigin = "left center";
      doorLeft.style.transform = "scaleX(1)";
      doorRight.style.transform = "scaleX(1)";
      if (brandSeam) {
        brandSeam.style.opacity = "0";
        brandSeam.style.transform = "translateX(-50%) scaleY(0.15)";
      }
      if (brandName) {
        brandName.style.opacity = "0";
        brandName.style.transform = "translateY(28px)";
        brandName.style.filter = "none";
      }
      if (brandSub) {
        brandSub.style.opacity = "0";
        brandSub.style.transform = "translateY(12px)";
      }
      if (brandCopy) {
        brandCopy.style.opacity = "0";
        brandCopy.style.transform = "translateY(16px)";
      }
      brandChips.forEach((chip) => {
        const o = chipFrom[chip.getAttribute("data-chip-from")] || { x: 0, y: 16 };
        chip.style.opacity = "0";
        chip.style.transform = `translate(${o.x}px, ${o.y}px)`;
      });

      const easeOpen = gsap.parseEase("power2.inOut");

      ScrollTrigger.create({
        trigger: revealTrack,
        start: "top top",
        end: () => {
          const spacer = document.getElementById("ssRevealSpacer");
          return `+=${spacer ? spacer.offsetHeight : Math.round(window.innerHeight * 0.9)}`;
        },
        pin: true,
        pinSpacing: false,
        scrub: 0.45,
        anticipatePin: 1,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
          // Open doors in the first ~50% of the pin, then hold fully open until handoff
          const open = easeOpen(Math.min(1, self.progress / 0.5));
          const scale = 1 - open;
          doorLeft.style.transform = `scaleX(${scale})`;
          doorRight.style.transform = `scaleX(${scale})`;

          if (brandSeam) {
            const seam = open > 0.03 && open < 0.95 ? Math.sin(open * Math.PI) : 0;
            brandSeam.style.opacity = String(seam * 0.9);
            brandSeam.style.transform = `translateX(-50%) scaleY(${0.15 + seam * 0.85})`;
          }

          heroEl.style.opacity = String(1 - Math.min(1, open * 1.2));
          heroEl.style.transform = `translateY(${-8 * open}px) scale(${1 - 0.015 * open})`;
          if (scrollHint) scrollHint.style.opacity = String(open > 0.05 ? 0 : 1);

          const showContent = Math.min(1, Math.max(0, (open - 0.28) / 0.5));
          if (brandName) {
            brandName.style.opacity = String(showContent);
            brandName.style.transform = `translateY(${28 * (1 - showContent)}px)`;
            brandName.style.filter = "none";
          }
          if (brandSub) {
            const s = Math.min(1, Math.max(0, (open - 0.4) / 0.42));
            brandSub.style.opacity = String(s * 0.9);
            brandSub.style.transform = `translateY(${12 * (1 - s)}px)`;
          }
          if (brandCopy) {
            const c = Math.min(1, Math.max(0, (open - 0.48) / 0.4));
            brandCopy.style.opacity = String(c);
            brandCopy.style.transform = `translateY(${16 * (1 - c)}px)`;
          }
          brandChips.forEach((chip, i) => {
            const c = Math.min(1, Math.max(0, (open - 0.45 - i * 0.04) / 0.38));
            const o = chipFrom[chip.getAttribute("data-chip-from")] || { x: 0, y: 16 };
            chip.style.opacity = String(c);
            chip.style.transform = `translate(${o.x * (1 - c)}px, ${o.y * (1 - c)}px)`;
          });
        },
      });
    }
  }

  /* Later sections — keep visible; light lift-in only when entering */
  if (hasGsap && !reduce) {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".ss-panel").forEach((panel) => {
      if (panel.classList.contains("ss-work")) return;
      const inner = panel.querySelector("[data-ss-panel-inner]") || panel;
      gsap.from(inner, {
        y: 24,
        duration: 0.55,
        ease: "power2.out",
        clearProps: "transform",
        scrollTrigger: {
          trigger: panel,
          start: "top 90%",
          once: true,
        },
      });
    });

    root.querySelectorAll("[data-scramble]").forEach((el) => {
      const finalText = el.getAttribute("data-scramble") || el.textContent.trim();
      el.textContent = finalText;
      if (reduce) return;
      gsap.fromTo(
        el,
        { opacity: 0, y: 16 },
        {
          opacity: 1,
          y: 0,
          duration: 0.55,
          ease: "power2.out",
          scrollTrigger: { trigger: el, start: "top 90%", once: true },
        }
      );
    });
  } else {
    root.querySelectorAll("[data-scramble]").forEach((el) => {
      el.textContent = el.getAttribute("data-scramble") || el.textContent;
    });
  }

  /* Bridge scramble → smooth work filmstrip (scrubbed track) */
  const storyRoot = document.querySelector("[data-ss-story]");
  const bridgeLayer = document.getElementById("ssBridgeLayer");
  const workLayer = document.getElementById("ssWorkLayer");

  if (storyRoot && bridgeLayer && workLayer && hasGsap && workData.length) {
    gsap.registerPlugin(ScrollTrigger);

    const bridgeLines = [...bridgeLayer.querySelectorAll("[data-bridge-scramble]")];
    const bridgeCopy = bridgeLayer.querySelector("[data-bridge-copy]");
    const track = document.getElementById("ssWorkTrack");
    const cards = track ? [...track.querySelectorAll("[data-work-card]")] : [];
    const titleEl = document.getElementById("ssWorkTitle");
    const typeEl = document.getElementById("ssWorkType");
    const countEl = document.getElementById("ssWorkCount");
    const footL = document.getElementById("ssWorkFootL");
    const footR = document.getElementById("ssWorkFootR");
    const bar = document.getElementById("ssWorkProgress");
    const n = workData.length;
    let active = -1;
    let scrambleDone = false;
    let scrambleStarted = false;
    let storyTrigger = null;
    let cardStep = 0;

    const measureStep = () => {
      if (!cards.length) return 0;
      const gap = parseFloat(getComputedStyle(track).gap) || 16;
      cardStep = cards[0].offsetWidth + gap;
      return cardStep;
    };

    const setLabels = (idx) => {
      if (idx === active || !workData[idx]) return;
      active = idx;
      const item = workData[idx];
      if (titleEl) titleEl.textContent = item.title;
      if (typeEl) typeEl.textContent = item.type;
      if (countEl) countEl.textContent = `${String(idx + 1).padStart(2, "0")} / ${String(n).padStart(2, "0")}`;
      if (footL) footL.textContent = item.footL;
      if (footR) footR.textContent = item.footR;
    };

    const paintTrack = (progress) => {
      if (!track || !cards.length) return;
      if (!cardStep) measureStep();
      // 0 → first card centered; 1 → last card centered
      const maxI = Math.max(1, n - 1);
      const f = gsap.utils.clamp(0, maxI, progress * maxI);
      gsap.set(track, { x: -f * cardStep, force3D: true });

      const nearest = Math.round(f);
      cards.forEach((card, i) => {
        const dist = Math.abs(i - f);
        const focus = gsap.utils.clamp(0, 1, 1 - dist * 0.85);
        gsap.set(card, {
          scale: 0.88 + focus * 0.12,
          opacity: 0.4 + focus * 0.6,
          force3D: true,
        });
      });
      setLabels(nearest);
      if (bar) bar.style.width = `${progress * 100}%`;
    };

    const applyStoryProgress = (p) => {
      if (!scrambleDone) return;
      bridgeLayer.style.opacity = "0";
      bridgeLayer.style.pointerEvents = "none";
      workLayer.style.opacity = "1";
      workLayer.style.pointerEvents = "auto";
      // slight lead-in so first card holds briefly, then filmstrip moves
      const workP = gsap.utils.clamp(0, 1, (p - 0.06) / 0.94);
      paintTrack(workP);
    };

    const playBridgeIntro = async () => {
      if (scrambleStarted) return;
      scrambleStarted = true;
      bridgeLines.forEach((el) => {
        el.textContent = el.getAttribute("data-bridge-scramble") || "";
      });
      if (!reduce) {
        gsap.fromTo(
          bridgeLines,
          { opacity: 0, y: 18 },
          { opacity: 1, y: 0, duration: 0.45, stagger: 0.1, ease: "power2.out" }
        );
      }
      if (bridgeCopy) {
        gsap.to(bridgeCopy, { opacity: 1, duration: 0.35, ease: "power2.out", delay: reduce ? 0 : 0.15 });
      }
      await new Promise((r) => setTimeout(r, reduce ? 0 : 420));
      scrambleDone = true;
      measureStep();
      gsap.to(bridgeLayer, { opacity: 0, y: -16, duration: 0.4, ease: "power2.inOut" });
      gsap.to(workLayer, {
        opacity: 1,
        duration: 0.45,
        ease: "power2.out",
        onStart: () => {
          workLayer.style.pointerEvents = "auto";
          paintTrack(0);
        },
      });
      if (storyTrigger) applyStoryProgress(storyTrigger.progress);
    };

    measureStep();
    paintTrack(0);
    window.addEventListener("resize", () => {
      measureStep();
      if (storyTrigger && scrambleDone) paintTrack(gsap.utils.clamp(0, 1, (storyTrigger.progress - 0.06) / 0.94));
    });

    if (reduce) {
      bridgeLines.forEach((el) => {
        el.textContent = el.getAttribute("data-bridge-scramble") || "";
      });
      if (bridgeCopy) bridgeCopy.style.opacity = "1";
      bridgeLayer.style.opacity = "0";
      bridgeLayer.style.pointerEvents = "none";
      workLayer.style.opacity = "1";
      workLayer.style.pointerEvents = "auto";
      scrambleDone = true;
      paintTrack(0);
    }

    storyTrigger = ScrollTrigger.create({
      trigger: storyRoot,
      start: "top top",
      end: () => {
        const spacer = document.getElementById("ssStorySpacer");
        return `+=${spacer ? spacer.offsetHeight : Math.round(window.innerHeight * (0.75 + n * 0.55))}`;
      },
      pin: true,
      pinSpacing: false,
      scrub: 0.45,
      anticipatePin: 1,
      invalidateOnRefresh: true,
      onEnter: () => playBridgeIntro(),
      onEnterBack: () => {
        if (!scrambleStarted) playBridgeIntro();
      },
      onRefresh: () => measureStep(),
      onUpdate: (self) => {
        if (self.progress > 0.01) playBridgeIntro();
        if (scrambleDone) applyStoryProgress(self.progress);
      },
    });
  } else if (storyRoot) {
    const bridge = document.getElementById("ssBridgeLayer");
    const work = document.getElementById("ssWorkLayer");
    if (bridge) {
      bridge.querySelectorAll("[data-bridge-scramble]").forEach((el) => {
        el.textContent = el.getAttribute("data-bridge-scramble") || "";
      });
      bridge.style.opacity = "0";
      bridge.style.pointerEvents = "none";
    }
    if (work) {
      work.style.opacity = "1";
      work.style.pointerEvents = "auto";
    }
  }

  /* Quotes */
  const quotes = [...root.querySelectorAll(".ss-quote")];
  let q = 0;
  const showQ = (i) => {
    q = (i + quotes.length) % quotes.length;
    quotes.forEach((el, n) => {
      if (n === q) el.classList.remove("hidden");
      else el.classList.add("hidden");
    });
  };
  root.querySelector(".ss-quote-prev")?.addEventListener("click", () => showQ(q - 1));
  root.querySelector(".ss-quote-next")?.addEventListener("click", () => showQ(q + 1));

  /* Marquee */
  const track = root.querySelector(".ss-marquee");
  if (track && window.gsap && !reduce) {
    const width = track.scrollWidth / 2;
    gsap.to(track, {
      x: -width,
      duration: 28,
      ease: "none",
      repeat: -1,
    });
  }

  /* Reveals — never leave content invisible */
  if (hasGsap && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    root.querySelectorAll("[data-reveal]").forEach((el) => {
      gsap.from(el, {
        y: 18,
        duration: 0.35,
        ease: "power2.out",
        clearProps: "transform",
        scrollTrigger: { trigger: el, start: "top 92%", once: true },
      });
    });

    requestAnimationFrame(() => ScrollTrigger.refresh());
    window.addEventListener("load", () => ScrollTrigger.refresh());
  }
})();
