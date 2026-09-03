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

  /* Hero: each word scrambles ONLY one letter (rest stay fixed) */
  const title = document.querySelector("#ssHeroTitle");
  if (title) {
    const CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";

    const scrambleSingleLetter = (el, { durationMs = 900 } = {}) =>
      new Promise((resolve) => {
        const finalText = (el.getAttribute("data-final") || el.textContent || "").trim();
        if (reduce || finalText.length === 0) {
          el.textContent = finalText;
          return resolve();
        }

        const chars = finalText.split("");
        // pick one letter toward the middle (never scramble whole word)
        const idx = Math.min(chars.length - 1, Math.max(0, Math.floor(chars.length / 2)));
        const target = chars[idx];
        const pool = target === target.toLowerCase() ? CHARS.toLowerCase() : CHARS;
        const startAt = performance.now();

        const id = setInterval(() => {
          const t = Math.min(1, (performance.now() - startAt) / durationMs);
          if (t >= 1) {
            clearInterval(id);
            el.textContent = finalText;
            resolve();
            return;
          }
          chars[idx] = pool[(Math.random() * 26) | 0];
          el.textContent = chars.join("");
          chars[idx] = target; // keep source array clean for next paint base
        }, 40);
      });

    const runHeroScramble = async () => {
      const words = [...title.querySelectorAll("[data-hero-word]")];
      const marks = [...title.querySelectorAll("[data-hero-mark]")];
      marks.forEach((m) => {
        m.style.opacity = "0";
        m.style.transform = "scale(0.6)";
      });

      for (let i = 0; i < words.length; i++) {
        const el = words[i];
        const isScale = el.hasAttribute("data-hero-scale");
        const finalText = (el.getAttribute("data-final") || "").trim();
        el.style.opacity = "1";
        el.textContent = finalText;
        if (window.gsap) {
          gsap.fromTo(el, { y: 8, opacity: 0 }, { y: 0, opacity: 1, duration: 0.18, ease: "power2.out" });
        }
        await scrambleSingleLetter(el, { durationMs: isScale ? 1100 : 850 });
        await new Promise((r) => setTimeout(r, reduce ? 0 : 50));
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
    runHeroScramble();
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
        end: "bottom bottom",
        scrub: 0.35,
        invalidateOnRefresh: true,
        onUpdate: (self) => {
          // progress↑ doors open L+R; progress↓ doors close back to center
          const open = easeOpen(Math.min(1, self.progress / 0.72));
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

  /* Later sections — light enter only (no heavy clip delay) */
  if (hasGsap && !reduce) {
    gsap.registerPlugin(ScrollTrigger);

    gsap.utils.toArray(".ss-panel").forEach((panel) => {
      if (panel.classList.contains("ss-work")) return;
      const inner = panel.querySelector("[data-ss-panel-inner]") || panel;
      gsap.fromTo(
        inner,
        { autoAlpha: 0.65, y: 20 },
        {
          autoAlpha: 1,
          y: 0,
          ease: "none",
          scrollTrigger: {
            trigger: panel,
            start: "top 94%",
            end: "top 78%",
            scrub: true,
          },
        }
      );
    });

    root.querySelectorAll("[data-scramble]").forEach((el) => {
      // Services section has its own self-contained scramble script
      if (el.closest("[data-ss-services]")) return;
      const finalText = el.getAttribute("data-scramble") || el.textContent.trim();
      let done = false;
      ScrollTrigger.create({
        trigger: el,
        start: "top 90%",
        once: true,
        onEnter: () => {
          if (done) return;
          done = true;
          scrambleTo(el, finalText, 6);
        },
      });
    });
  } else {
    root.querySelectorAll("[data-scramble]").forEach((el) => {
      if (el.closest("[data-ss-services]")) return;
      el.textContent = el.getAttribute("data-scramble") || el.textContent;
    });
  }

  /* Bridge scramble → smooth work filmstrip (scrubbed track) */
  const storyRoot = document.querySelector("[data-ss-story]");
  const bridgeLayer = document.getElementById("ssBridgeLayer");
  const workLayer = document.getElementById("ssWorkLayer");

  if (storyRoot && bridgeLayer && workLayer && hasGsap && workData.length) {
    gsap.registerPlugin(ScrollTrigger);

    const CHARS = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789↘●";
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

    const scrambleLine = (el, durationMs = 900) =>
      new Promise((resolve) => {
        const target = el.getAttribute("data-bridge-scramble") || "";
        if (reduce) {
          el.textContent = target;
          return resolve();
        }
        const startAt = performance.now();
        const id = setInterval(() => {
          const prog = Math.min(1, (performance.now() - startAt) / durationMs);
          let out = "";
          for (let i = 0; i < target.length; i++) {
            if (target[i] === " ") {
              out += " ";
              continue;
            }
            out += prog >= (i + 1) / target.length ? target[i] : CHARS[(Math.random() * CHARS.length) | 0];
          }
          el.textContent = out;
          if (prog >= 1) {
            clearInterval(id);
            el.textContent = target;
            resolve();
          }
        }, 40);
      });

    const playBridgeScramble = async () => {
      if (scrambleStarted) return;
      scrambleStarted = true;
      for (const line of bridgeLines) {
        await scrambleLine(line, 900);
        await new Promise((r) => setTimeout(r, reduce ? 0 : 60));
      }
      if (bridgeCopy) {
        gsap.to(bridgeCopy, { opacity: 1, duration: 0.3, ease: "power2.out" });
      }
      await new Promise((r) => setTimeout(r, reduce ? 0 : 280));
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
      end: "bottom bottom",
      scrub: 0.35,
      invalidateOnRefresh: true,
      onEnter: () => playBridgeScramble(),
      onEnterBack: () => {
        if (!scrambleStarted) playBridgeScramble();
      },
      onRefresh: () => measureStep(),
      onUpdate: (self) => {
        if (self.progress > 0.01) playBridgeScramble();
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

  /* Reveals */
  if (hasGsap && !reduce) {
    gsap.registerPlugin(ScrollTrigger);
    root.querySelectorAll("[data-reveal]").forEach((el) => {
      gsap.fromTo(
        el,
        { opacity: 0.35, y: 18 },
        {
          opacity: 1,
          y: 0,
          duration: 0.35,
          ease: "power2.out",
          scrollTrigger: { trigger: el, start: "top 92%", once: true },
        }
      );
    });

    requestAnimationFrame(() => ScrollTrigger.refresh());
    window.addEventListener("load", () => ScrollTrigger.refresh());
  }
})();
