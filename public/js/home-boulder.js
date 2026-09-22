/* ScaleSphere home — Boulder-style panel opens + float + scramble */
(() => {
  const root = document.querySelector(".ss-home");
  if (!root) return;

  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const isTouch = window.matchMedia("(hover: none), (pointer: coarse)").matches;
  const isNarrow = window.matchMedia("(max-width: 900px)").matches || isTouch;
  /* 1:1 scrub on touch/narrow — no lag catch-up that feels stuck */
  const scrubAmt = isNarrow ? true : 0.12;
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

  /* Floating chips — services floats left-only; hero floats separate */
  if (hasGsap && !reduce && window.innerWidth >= 1024) {
    root.querySelectorAll("#ss-services [data-float]").forEach((el, i) => {
      gsap.to(el, {
        y: i % 2 === 0 ? -8 : 8,
        duration: 3.4 + (i % 3) * 0.35,
        yoyo: true,
        repeat: -1,
        ease: "sine.inOut",
        delay: i * 0.12,
      });
    });
  }
  if (hasGsap && !reduce && window.innerWidth >= 768) {
    root.querySelectorAll("[data-float-hero]").forEach((el, i) => {
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
  const brandChips = brandPanel
    ? [...brandPanel.querySelectorAll("[data-brand-chip]")]
    : [];
  const heroFloats = [...root.querySelectorAll("[data-float-hero]")];
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

      /* Narrow: no pin — open doors once on scroll, no blank spacer lag */
      if (isNarrow) {
        const openDoors = (open) => {
          const o = easeOpen(Math.min(1, open));
          const scale = 1 - o;
          doorLeft.style.transform = `scaleX(${scale})`;
          doorRight.style.transform = `scaleX(${scale})`;
          heroEl.style.opacity = String(1 - Math.min(1, o * 1.2));
          heroFloats.forEach((el) => { el.style.opacity = "0"; });
          if (scrollHint) scrollHint.style.opacity = "0";
          const showContent = Math.min(1, Math.max(0, (o - 0.2) / 0.55));
          if (brandName) { brandName.style.opacity = String(showContent); brandName.style.transform = "none"; }
          if (brandSub) { brandSub.style.opacity = String(showContent * 0.9); brandSub.style.transform = "none"; }
          if (brandCopy) { brandCopy.style.opacity = String(showContent); brandCopy.style.transform = "none"; }
          brandChips.forEach((chip) => { chip.style.opacity = String(showContent); chip.style.transform = "none"; });
        };
        ScrollTrigger.create({
          trigger: revealTrack,
          start: "top top",
          end: "bottom top",
          scrub: true,
          onUpdate: (self) => openDoors(Math.min(1, self.progress * 1.4)),
          onLeave: () => openDoors(1),
        });
      } else {
      ScrollTrigger.create({
        trigger: revealTrack,
        start: "top top",
        end: () => `+=${Math.round(window.innerHeight * 0.85)}`,
        pin: true,
        pinSpacing: true,
        scrub: scrubAmt,
        anticipatePin: 0,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
          // Open doors in the first ~50% of the pin, then hold fully open until handoff
          const open = easeOpen(Math.min(1, self.progress / 0.5));
          const scale = 1 - open;
          doorLeft.style.transform = `scaleX(${scale})`;
          doorRight.style.transform = `scaleX(${scale})`;

          heroEl.style.opacity = String(1 - Math.min(1, open * 1.2));
          heroEl.style.transform = `translateY(${-8 * open}px) scale(${1 - 0.015 * open})`;
          /* Hide hero floats early so they don't stack over brand chips */
          const floatHide = Math.min(1, open * 2.2);
          heroFloats.forEach((el) => {
            el.style.opacity = String(1 - floatHide);
            el.style.pointerEvents = "none";
          });
          if (scrollHint) scrollHint.style.opacity = String(open > 0.05 ? 0 : 1);

          /* Soft fade out of blue pin into white — avoid transform (fights pin) */
          const exit = Math.min(1, Math.max(0, (self.progress - 0.85) / 0.15));
          revealTrack.style.opacity = String(1 - exit * 0.4);

          const showContent = Math.min(1, Math.max(0, (open - 0.28) / 0.5));
          if (brandName) {
            brandName.style.opacity = String(showContent * (1 - exit * 0.5));
            brandName.style.transform = `translateY(${28 * (1 - showContent)}px)`;
            brandName.style.filter = "none";
          }
          if (brandSub) {
            const s = Math.min(1, Math.max(0, (open - 0.4) / 0.42));
            brandSub.style.opacity = String(s * 0.9 * (1 - exit));
            brandSub.style.transform = `translateY(${12 * (1 - s)}px)`;
          }
          if (brandCopy) {
            const c = Math.min(1, Math.max(0, (open - 0.48) / 0.4));
            brandCopy.style.opacity = String(c * (1 - exit));
            brandCopy.style.transform = `translateY(${16 * (1 - c)}px)`;
          }
          brandChips.forEach((chip, i) => {
            const c = Math.min(1, Math.max(0, (open - 0.45 - i * 0.04) / 0.38));
            const o = chipFrom[chip.getAttribute("data-chip-from")] || { x: 0, y: 16 };
            chip.style.opacity = String(c * (1 - exit));
            chip.style.transform = `translate(${o.x * (1 - c)}px, ${o.y * (1 - c)}px)`;
          });
        },
        onLeave: () => {
          revealTrack.style.opacity = "1";
        },
        onEnterBack: () => {
          revealTrack.style.opacity = "1";
        },
      });
      }
    }
  }

  /* Later sections — keep visible; light lift-in only when entering */
  if (hasGsap && !reduce && !isNarrow) {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".ss-panel").forEach((panel) => {
      if (panel.classList.contains("ss-work") || panel.id === "ss-work") return;
      const inner = panel.querySelector("[data-ss-panel-inner]") || panel;
      gsap.from(inner, {
        y: 8,
        duration: 0.3,
        ease: "power2.out",
        clearProps: "transform",
        scrollTrigger: {
          trigger: panel,
          start: "top 94%",
          once: true,
        },
      });
    });

    root.querySelectorAll("[data-scramble]").forEach((el) => {
      const finalText = el.getAttribute("data-scramble") || el.textContent.trim();
      el.textContent = finalText;
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
        /* No scale — scale caused the bounce / uchhal feel */
        gsap.set(card, {
          scale: 1,
          opacity: 0.55 + focus * 0.45,
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
      const workP = gsap.utils.clamp(0, 1, (p - 0.06) / 0.94);
      paintTrack(workP);
    };

    const playBridgeIntro = async () => {
      if (scrambleStarted) return;
      scrambleStarted = true;
      /* Skip bounce-in — show work strip immediately */
      bridgeLines.forEach((el) => {
        el.textContent = el.getAttribute("data-bridge-scramble") || "";
      });
      if (bridgeCopy) bridgeCopy.style.opacity = "0";
      bridgeLayer.style.opacity = "0";
      bridgeLayer.style.pointerEvents = "none";
      workLayer.style.opacity = "1";
      workLayer.style.pointerEvents = "auto";
      scrambleDone = true;
      measureStep();
      paintTrack(0);
      if (storyTrigger) applyStoryProgress(storyTrigger.progress);
    };

    measureStep();
    paintTrack(0);
    window.addEventListener("resize", () => {
      measureStep();
      if (storyTrigger && scrambleDone) paintTrack(gsap.utils.clamp(0, 1, (storyTrigger.progress - 0.06) / 0.94));
    });

    if (reduce || isNarrow) {
      bridgeLines.forEach((el) => {
        el.textContent = el.getAttribute("data-bridge-scramble") || "";
      });
      if (bridgeCopy) bridgeCopy.style.opacity = "0";
      bridgeLayer.style.opacity = "0";
      bridgeLayer.style.pointerEvents = "none";
      workLayer.style.opacity = "1";
      workLayer.style.pointerEvents = "auto";
      scrambleDone = true;
      scrambleStarted = true;
      /* Native swipe carousel — no pin lag on small screens */
      if (track) {
        track.style.transform = "none";
        const stage = document.getElementById("ssWorkStage");
        if (stage) {
          stage.style.overflowX = "auto";
          stage.style.webkitOverflowScrolling = "touch";
          stage.style.scrollSnapType = "x mandatory";
        }
        cards.forEach((card) => {
          card.style.scale = "1";
          card.style.opacity = "1";
          card.style.scrollSnapAlign = "center";
        });
        track.style.paddingInline = "1rem";
      }
      paintTrack(0);
      storyRoot.style.height = "auto";
      storyRoot.style.minHeight = "0";
    } else {
      storyTrigger = ScrollTrigger.create({
        trigger: storyRoot,
        start: "top top",
        end: () => `+=${Math.round(window.innerHeight * (0.65 + n * 0.45))}`,
        pin: true,
        pinSpacing: true,
        scrub: true,
        anticipatePin: 0,
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
    }
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

  /* Marquee uses CSS (smoother; no ScrollTrigger conflict) */

  /* Reveals — never leave content invisible */
  if (hasGsap && !reduce && !isNarrow) {
    gsap.registerPlugin(ScrollTrigger);
    root.querySelectorAll("[data-reveal]").forEach((el) => {
      gsap.from(el, {
        y: 10,
        duration: 0.28,
        ease: "power2.out",
        clearProps: "transform",
        scrollTrigger: { trigger: el, start: "top 94%", once: true },
      });
    });

    const refresh = () => ScrollTrigger.refresh();
    requestAnimationFrame(refresh);
    window.addEventListener("load", refresh);
    window.addEventListener("resize", () => {
      clearTimeout(window.__ssStRefresh);
      window.__ssStRefresh = setTimeout(refresh, 120);
    });
  } else {
    root.querySelectorAll("[data-reveal]").forEach((el) => {
      el.style.opacity = "1";
      el.style.transform = "none";
    });
  }
})();
