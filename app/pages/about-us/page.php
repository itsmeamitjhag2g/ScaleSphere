<?php
$site = ts_site();

$aboutStats = [
    ["value" => "120+", "target" => 120, "icon" => "fa-folder-open", "label" => "Projects Delivered", "tone" => "blue"],
    ["value" => "98%",  "target" => 98,  "icon" => "fa-smile-beam", "label" => "Client Retention", "tone" => "green"],
    ["value" => "5+",   "target" => 5,   "icon" => "fa-award", "label" => "Years of Excellence", "tone" => "purple"],
    ["value" => "40+",  "target" => 40,  "icon" => "fa-users", "label" => "Digital Specialists", "tone" => "orange"],
];

$values = [
    [
        "icon" => "fa-bullseye",
        "title" => "Outcome Driven",
        "desc" => "We focus on business outcomes, not just delivering features or designs."
    ],
    [
        "icon" => "fa-lightbulb",
        "title" => "Think Different",
        "desc" => "We combine strategy, creativity and technology to solve real problems."
    ],
    [
        "icon" => "fa-handshake",
        "title" => "Built On Trust",
        "desc" => "Clear communication, honest timelines and long-term partnerships."
    ],
    [
        "icon" => "fa-chart-line",
        "title" => "Always Improving",
        "desc" => "We continuously optimize products, processes and digital experiences."
    ],
];

$journey = [
    [
        "year" => "01",
        "title" => "Understand",
        "desc" => "We start by understanding your business, audience, goals and challenges."
    ],
    [
        "year" => "02",
        "title" => "Plan",
        "desc" => "Strategy, technology and milestones are aligned around measurable outcomes."
    ],
    [
        "year" => "03",
        "title" => "Create",
        "desc" => "Our designers and developers turn ideas into polished digital experiences."
    ],
    [
        "year" => "04",
        "title" => "Launch",
        "desc" => "We test, refine and launch with a focus on performance and reliability."
    ],
    [
        "year" => "05",
        "title" => "Grow",
        "desc" => "After launch, we keep optimizing your digital presence for sustainable growth."
    ],
];

ob_start();
?>

<style>
/* =========================================================
   ScaleSphere — About Page
   Same visual language as homepage
   ========================================================= */

:root{
    --ab-ink:#101a33;
    --ab-muted:#64708a;
    --ab-blue:#1769ff;
    --ab-blue-2:#4c8dff;
    --ab-cyan:#22b8ff;
    --ab-green:#20bf83;
    --ab-purple:#8b5cf6;
    --ab-orange:#ff9b4a;
    --ab-bg:#fff;
    --ab-soft:#f6f9ff;
    --ab-border:#e4eaf4;
    --ab-shadow:0 18px 55px rgba(28,66,130,.09);
    --ab-wrap:min(1400px,100% - 32px);
}

.ss-about, .ss-about *{ box-sizing:border-box; }
.ss-about{
    background:#fff;
    color:var(--ab-ink);
    overflow:hidden;
    overflow-x:hidden;
    width:100%;
    font-family:inherit;
}
.ss-about img{
    max-width:100%;
    height:auto;
    display:block;
}

.ss-about *,
.ss-about *:before,
.ss-about *:after{
    box-sizing:border-box;
}

.ss-about-wrap{
    width:var(--ab-wrap);
    max-width:100%;
    margin:auto;
    padding:0 16px;
}

.ss-about-blue{
    color:var(--ab-blue);
}

.ss-about-label{
    display:inline-block;
    color:var(--ab-blue);
    font-size:12px;
    font-weight:800;
    letter-spacing:.13em;
    text-transform:uppercase;
    margin-bottom:11px;
}

.ss-about-btn{
    min-height:48px;
    padding:0 21px;
    border-radius:10px;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    font-size:14px;
    font-weight:700;
    text-decoration:none!important;
    transition:
        transform .25s ease,
        box-shadow .25s ease,
        background .25s ease,
        border-color .25s ease;
}

.ss-about-btn:hover{
    transform:translateY(-3px);
}

.ss-about-btn-fill{
    color:#fff!important;
    background:linear-gradient(135deg,#1769ff,#2e7cff);
    box-shadow:0 12px 28px rgba(23,105,255,.23);
}

.ss-about-btn-fill:hover{
    box-shadow:0 17px 35px rgba(23,105,255,.30);
}

.ss-about-btn-line{
    color:var(--ab-ink)!important;
    background:#fff;
    border:1px solid #dce4f1;
}

.ss-about-btn-line:hover{
    border-color:#a9c4ff;
    box-shadow:0 10px 25px rgba(24,72,150,.08);
}


/* =========================================================
   REVEAL
   ========================================================= */

.ss-about-reveal{
    opacity:0;
    transform:translateY(28px);
    transition:
        opacity .75s ease,
        transform .75s cubic-bezier(.22,.61,.36,1);
}

.ss-about-reveal.ss-about-visible{
    opacity:1;
    transform:none;
}

.ss-about-delay-1{
    transition-delay:.08s;
}

.ss-about-delay-2{
    transition-delay:.16s;
}

.ss-about-delay-3{
    transition-delay:.24s;
}

.ss-about-delay-4{
    transition-delay:.32s;
}


/* =========================================================
   HERO
   ========================================================= */

.ss-about-hero{
    min-height:650px;
    position:relative;
    display:flex;
    align-items:center;
    padding:90px 0 85px;
    isolation:isolate;
    background:
        radial-gradient(
            circle at 78% 30%,
            rgba(55,131,255,.14),
            transparent 28%
        ),
        radial-gradient(
            circle at 92% 80%,
            rgba(34,184,255,.10),
            transparent 25%
        ),
        linear-gradient(
            180deg,
            #fff 0%,
            #fbfdff 100%
        );
}

.ss-about-hero-bg{
    position:absolute;
    inset:0;
    z-index:-1;
    pointer-events:none;
    overflow:hidden;
}

.ss-about-grid-lines{
    position:absolute;
    right:-12%;
    top:-20%;
    width:65%;
    height:140%;
    opacity:.42;

    background-image:
        linear-gradient(
            rgba(23,105,255,.055) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(23,105,255,.055) 1px,
            transparent 1px
        );

    background-size:44px 44px;

    mask-image:
        radial-gradient(
            circle at 50% 50%,
            #000 0%,
            transparent 72%
        );
}

.ss-about-beam{
    position:absolute;
    width:1px;
    height:120%;
    left:72%;
    top:-10%;
    background:
        linear-gradient(
            180deg,
            transparent,
            rgba(23,105,255,.18),
            transparent
        );
    transform:rotate(15deg);
    animation:ssAboutBeam 6s ease-in-out infinite;
}

@keyframes ssAboutBeam{
    50%{
        opacity:.45;
        transform:rotate(15deg) translateX(35px);
    }
}

.ss-about-orb{
    position:absolute;
    border-radius:50%;
    animation:ssAboutFloat 7s ease-in-out infinite;
}

.ss-about-orb-a{
    width:300px;
    height:300px;
    right:7%;
    top:6%;
    background:rgba(55,131,255,.08);
}

.ss-about-orb-b{
    width:125px;
    height:125px;
    right:32%;
    bottom:10%;
    background:rgba(34,184,255,.09);
    animation-delay:-2.5s;
}

@keyframes ssAboutFloat{
    50%{
        transform:translate3d(0,-15px,0);
    }
}

.ss-about-hero-grid{
    display:grid;
    grid-template-columns:minmax(0,1fr) minmax(430px,.85fr);
    gap:70px;
    align-items:center;
}

.ss-about-hero-copy{
    position:relative;
    z-index:3;
}

.ss-about-kicker{
    display:inline-flex;
    align-items:center;
    gap:9px;
    padding:8px 13px;
    border:1px solid #dce8ff;
    border-radius:999px;
    background:#f4f8ff;
    color:var(--ab-blue);
    font-size:11px;
    font-weight:800;
    letter-spacing:.07em;
    text-transform:uppercase;
}

.ss-about-kicker i{
    font-size:10px;
}

.ss-about-hero h1{
    max-width:720px;
    margin:20px 0 20px;
    font-size:clamp(46px,5.8vw,76px);
    line-height:1.01;
    letter-spacing:-.055em;
    font-weight:800;
}

.ss-about-hero-copy>p{
    max-width:620px;
    margin:0;
    color:var(--ab-muted);
    font-size:17px;
    line-height:1.8;
}

.ss-about-hero-buttons{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
    margin-top:30px;
}


/* =========================================================
   HERO VISUAL
   ========================================================= */

.ss-about-visual{
    min-height:440px;
    position:relative;
    display:flex;
    align-items:center;
    justify-content:center;
}

.ss-about-visual:before{
    content:"";
    position:absolute;
    width:390px;
    height:390px;
    border-radius:50%;

    background:
        radial-gradient(
            circle,
            rgba(63,137,255,.16),
            rgba(63,137,255,.05) 42%,
            transparent 68%
        );

    animation:ssAboutPulse 5s ease-in-out infinite;
}

@keyframes ssAboutPulse{
    50%{
        transform:scale(1.07);
        opacity:.75;
    }
}

.ss-about-ring{
    position:absolute;
    width:390px;
    height:390px;
    border-radius:50%;
    border:1px solid rgba(23,105,255,.14);
    animation:ssAboutRotate 18s linear infinite;
}

.ss-about-ring:before,
.ss-about-ring:after{
    content:"";
    position:absolute;
    width:9px;
    height:9px;
    border-radius:50%;
    background:var(--ab-blue);
    box-shadow:0 0 20px rgba(23,105,255,.55);
}

.ss-about-ring:before{
    left:13%;
    top:8%;
}

.ss-about-ring:after{
    right:9%;
    bottom:18%;
    background:var(--ab-cyan);
}

@keyframes ssAboutRotate{
    to{
        transform:rotate(360deg);
    }
}


/* Main visual card */

.ss-about-core{
    width:min(370px,88%);
    min-height:285px;
    position:relative;
    z-index:3;

    padding:25px;

    border:1px solid #dfe8f5;
    border-radius:24px;

    background:
        linear-gradient(
            145deg,
            rgba(255,255,255,.98),
            rgba(247,250,255,.96)
        );

    box-shadow:
        0 30px 70px rgba(34,75,135,.13);

    animation:ssAboutCoreFloat 6s ease-in-out infinite;
}

@keyframes ssAboutCoreFloat{
    50%{
        transform:translateY(-9px);
    }
}

.ss-about-core-top{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:28px;
}

.ss-about-core-brand{
    display:flex;
    align-items:center;
    gap:9px;
}

.ss-about-core-brand-mark{
    width:30px;
    height:30px;
    display:grid;
    place-items:center;
    border-radius:9px;
    color:#fff;
    background:linear-gradient(135deg,#1769ff,#4c8dff);
    font-size:12px;
}

.ss-about-core-brand strong{
    font-size:12px;
}

.ss-about-status{
    display:flex;
    align-items:center;
    gap:5px;
    color:var(--ab-green);
    font-size:9px;
    font-weight:800;
}

.ss-about-status i{
    width:6px;
    height:6px;
    border-radius:50%;
    background:var(--ab-green);
    animation:ssStatus 1.8s ease-in-out infinite;
}

@keyframes ssStatus{
    50%{
        opacity:.35;
        transform:scale(.7);
    }
}

.ss-about-core-title{
    font-size:27px;
    line-height:1.12;
    letter-spacing:-.04em;
    font-weight:800;
    margin-bottom:8px;
}

.ss-about-core-text{
    color:#758199;
    font-size:11px;
    line-height:1.7;
    max-width:280px;
}

.ss-about-progress{
    margin-top:25px;
}

.ss-about-progress-row{
    display:flex;
    align-items:center;
    justify-content:space-between;
    margin-bottom:7px;
}

.ss-about-progress-row span{
    color:#758199;
    font-size:9px;
}

.ss-about-progress-row strong{
    font-size:10px;
}

.ss-about-progress-bar{
    height:7px;
    overflow:hidden;
    border-radius:99px;
    background:#eaf0f8;
}

.ss-about-progress-bar span{
    display:block;
    width:86%;
    height:100%;
    border-radius:99px;
    background:linear-gradient(90deg,#1769ff,#53a4ff);
    animation:ssProgress 2s ease-out;
}

@keyframes ssProgress{
    from{
        width:0;
    }
}

.ss-about-core-footer{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:8px;
    margin-top:22px;
}

.ss-about-mini{
    padding:10px;
    border:1px solid #e8edf5;
    border-radius:10px;
    background:#fff;
}

.ss-about-mini small{
    display:block;
    color:#8b96aa;
    font-size:7px;
}

.ss-about-mini strong{
    display:block;
    margin-top:4px;
    font-size:13px;
}

.ss-about-floating{
    position:absolute;
    z-index:5;
    padding:12px 14px;
    border:1px solid #e0e8f3;
    border-radius:13px;
    background:rgba(255,255,255,.96);
    box-shadow:0 18px 40px rgba(36,76,130,.12);
    animation:ssAboutCardFloat 5s ease-in-out infinite;
}

@keyframes ssAboutCardFloat{
    50%{
        transform:translateY(-10px);
    }
}

.ss-about-floating small{
    display:block;
    color:#8995a9;
    font-size:9px;
}

.ss-about-floating strong{
    display:block;
    margin-top:4px;
    font-size:18px;
}

.ss-about-float-a{
    left:0;
    top:18%;
}

.ss-about-float-a strong{
    color:var(--ab-blue);
}

.ss-about-float-b{
    right:0;
    bottom:17%;
    animation-delay:-2s;
}

.ss-about-float-b strong{
    color:var(--ab-green);
}


/* =========================================================
   INTRO / STORY
   ========================================================= */

.ss-about-story{
    padding:105px 0;
    background:#fff;
}

.ss-about-story-grid{
    display:grid;
    grid-template-columns:.85fr 1.15fr;
    gap:90px;
    align-items:start;
}

.ss-about-story-side{
    position:sticky;
    top:100px;
}

.ss-about-story-side h2{
    margin:0;
    font-size:clamp(35px,4vw,49px);
    line-height:1.08;
    letter-spacing:-.04em;
}

.ss-about-story-copy p{
    margin:0 0 20px;
    color:var(--ab-muted);
    font-size:15px;
    line-height:1.9;
}

.ss-about-story-copy p:first-child{
    color:#273450;
    font-size:18px;
    line-height:1.75;
    font-weight:500;
}


/* Highlight box */

.ss-about-highlight{
    margin-top:35px;
    padding:22px;
    border-radius:17px;
    border:1px solid #dfe8f5;
    background:
        linear-gradient(
            135deg,
            #f5f9ff,
            #fff
        );
}

.ss-about-highlight-icon{
    width:43px;
    height:43px;
    display:grid;
    place-items:center;
    margin-bottom:15px;
    border-radius:12px;
    background:#eaf2ff;
    color:var(--ab-blue);
}

.ss-about-highlight strong{
    display:block;
    margin-bottom:7px;
    font-size:15px;
}

.ss-about-highlight span{
    color:var(--ab-muted);
    font-size:11px;
    line-height:1.6;
}


/* =========================================================
   STATS
   ========================================================= */

.ss-about-stats{
    padding:0 0 95px;
}

.ss-about-stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    border:1px solid #e1e8f2;
    border-radius:21px;
    background:#fff;
    box-shadow:0 17px 45px rgba(35,72,126,.07);
    padding:10px;
}

.ss-about-stat{
    display:grid;
    grid-template-columns:48px 1fr;
    align-items:center;
    gap:13px;
    padding:22px;
    border-right:1px solid #e9eef5;
}

.ss-about-stat:last-child{
    border-right:0;
}

.ss-about-stat-icon{
    width:48px;
    height:48px;
    display:grid;
    place-items:center;
    border-radius:14px;
}

.ss-about-stat-blue .ss-about-stat-icon{
    color:var(--ab-blue);
    background:#eef5ff;
}

.ss-about-stat-green .ss-about-stat-icon{
    color:var(--ab-green);
    background:#edfbf6;
}

.ss-about-stat-purple .ss-about-stat-icon{
    color:var(--ab-purple);
    background:#f4efff;
}

.ss-about-stat-orange .ss-about-stat-icon{
    color:var(--ab-orange);
    background:#fff5ea;
}

.ss-about-stat strong{
    display:block;
    font-size:26px;
    line-height:1;
}

.ss-about-stat span{
    display:block;
    margin-top:6px;
    color:var(--ab-muted);
    font-size:10px;
}


/* =========================================================
   VALUES
   ========================================================= */

.ss-about-values{
    padding:105px 0;
    background:
        linear-gradient(
            180deg,
            #f7faff,
            #fff
        );
}

.ss-about-section-head{
    max-width:720px;
    margin-bottom:45px;
}

.ss-about-section-head h2{
    margin:0;
    font-size:clamp(34px,4vw,48px);
    line-height:1.08;
    letter-spacing:-.04em;
}

.ss-about-section-head p{
    margin:15px 0 0;
    color:var(--ab-muted);
    font-size:14px;
    line-height:1.75;
    max-width:610px;
}

.ss-about-values-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:17px;
}

.ss-about-value{
    position:relative;
    min-height:250px;
    padding:26px;
    overflow:hidden;
    border:1px solid #e1e8f2;
    border-radius:18px;
    background:#fff;
    transition:
        transform .3s ease,
        box-shadow .3s ease,
        border-color .3s ease;
}

.ss-about-value:hover{
    transform:translateY(-8px);
    border-color:#cbdcff;
    box-shadow:var(--ab-shadow);
}

.ss-about-value-number{
    position:absolute;
    right:21px;
    top:18px;
    color:#dbe4f0;
    font-size:17px;
    font-weight:800;
}

.ss-about-value-icon{
    width:50px;
    height:50px;
    display:grid;
    place-items:center;
    margin-bottom:28px;
    border-radius:14px;
    color:#fff;
    background:linear-gradient(135deg,#1769ff,#4c8dff);
}

.ss-about-value:nth-child(2) .ss-about-value-icon{
    background:linear-gradient(135deg,#12ae78,#50d6a5);
}

.ss-about-value:nth-child(3) .ss-about-value-icon{
    background:linear-gradient(135deg,#7744ef,#ad82ff);
}

.ss-about-value:nth-child(4) .ss-about-value-icon{
    background:linear-gradient(135deg,#f48a2b,#ffc06d);
}

.ss-about-value h3{
    margin:0 0 10px;
    font-size:17px;
}

.ss-about-value p{
    margin:0;
    max-width:245px;
    color:var(--ab-muted);
    font-size:12px;
    line-height:1.75;
}

.ss-about-value-glow{
    position:absolute;
    width:160px;
    height:160px;
    right:-95px;
    bottom:-105px;
    border-radius:50%;
    background:#6aa3ff;
    opacity:.12;
    transition:transform .4s ease;
}

.ss-about-value:hover .ss-about-value-glow{
    transform:scale(1.3);
}


/* =========================================================
   JOURNEY
   ========================================================= */

.ss-about-journey{
    padding:110px 0;
    background:#fff;
}

.ss-about-journey-head{
    text-align:center;
    margin-bottom:60px;
}

.ss-about-journey-head h2{
    margin:0;
    font-size:clamp(34px,4vw,48px);
    line-height:1.08;
    letter-spacing:-.04em;
}

.ss-about-journey-head p{
    max-width:600px;
    margin:15px auto 0;
    color:var(--ab-muted);
    font-size:14px;
    line-height:1.75;
}

.ss-about-timeline{
    max-width:950px;
    margin:auto;
    position:relative;
}

.ss-about-timeline:before{
    content:"";
    position:absolute;
    top:0;
    bottom:0;
    left:50%;
    width:1px;
    background:
        linear-gradient(
            180deg,
            #b9d0ff,
            #e4ebf5,
            #b9d0ff
        );
    transform:translateX(-50%);
}

.ss-about-timeline-item{
    width:50%;
    position:relative;
    padding:0 55px 60px 0;
}

.ss-about-timeline-item:nth-child(even){
    margin-left:50%;
    padding:0 0 60px 55px;
}

.ss-about-timeline-dot{
    position:absolute;
    top:0;
    right:-7px;
    width:14px;
    height:14px;
    border-radius:50%;
    background:var(--ab-blue);
    border:4px solid #fff;
    box-shadow:
        0 0 0 1px #c7d8f7,
        0 5px 15px rgba(23,105,255,.22);
}

.ss-about-timeline-item:nth-child(even) .ss-about-timeline-dot{
    right:auto;
    left:-7px;
}

.ss-about-timeline-card{
    padding:22px;
    border:1px solid #e2e9f3;
    border-radius:16px;
    background:
        linear-gradient(
            145deg,
            #fff,
            #fbfdff
        );
    transition:
        transform .3s ease,
        box-shadow .3s ease;
}

.ss-about-timeline-card:hover{
    transform:translateY(-5px);
    box-shadow:0 17px 40px rgba(35,73,130,.08);
}

.ss-about-timeline-year{
    display:inline-flex;
    min-width:34px;
    justify-content:center;
    margin-bottom:11px;
    padding:5px 8px;
    border-radius:6px;
    background:#eef5ff;
    color:var(--ab-blue);
    font-size:9px;
    font-weight:800;
}

.ss-about-timeline-card h3{
    margin:0 0 8px;
    font-size:17px;
}

.ss-about-timeline-card p{
    margin:0;
    color:var(--ab-muted);
    font-size:11px;
    line-height:1.7;
}


/* =========================================================
   DIFFERENCE
   ========================================================= */

.ss-about-difference{
    padding:100px 0;
    background:#f7faff;
}

.ss-about-difference-box{
    position:relative;
    overflow:hidden;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:65px;
    align-items:center;

    padding:65px;

    border-radius:25px;

    background:
        radial-gradient(
            circle at 80% 20%,
            rgba(76,141,255,.18),
            transparent 32%
        ),
        linear-gradient(
            135deg,
            #071d50,
            #0c4fba 70%,
            #1287e8
        );

    color:#fff;
}

.ss-about-difference-box:after{
    content:"";
    position:absolute;
    width:480px;
    height:170px;
    right:-100px;
    bottom:-95px;
    border:1px solid rgba(255,255,255,.2);
    border-radius:50%;
    transform:rotate(-10deg);
}

.ss-about-difference-copy{
    position:relative;
    z-index:2;
}

.ss-about-difference-copy .ss-about-label{
    color:#c8ddff;
}

.ss-about-difference-copy h2{
    margin:0;
    max-width:570px;
    font-size:clamp(34px,4vw,48px);
    line-height:1.08;
    letter-spacing:-.04em;
}

.ss-about-difference-copy p{
    max-width:550px;
    margin:18px 0 0;
    color:rgba(255,255,255,.78);
    font-size:14px;
    line-height:1.8;
}

.ss-about-difference-list{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:12px;
}

.ss-about-difference-item{
    padding:19px;
    border:1px solid rgba(255,255,255,.17);
    border-radius:14px;
    background:rgba(255,255,255,.07);
    backdrop-filter:blur(7px);
}

.ss-about-difference-item i{
    display:block;
    margin-bottom:14px;
    color:#b9d7ff;
}

.ss-about-difference-item strong{
    display:block;
    margin-bottom:6px;
    font-size:13px;
}

.ss-about-difference-item span{
    display:block;
    color:rgba(255,255,255,.68);
    font-size:10px;
    line-height:1.6;
}


/* =========================================================
   CTA
   ========================================================= */

.ss-about-cta{
    padding:100px 0 110px;
    text-align:center;
    background:#fff;
}

.ss-about-cta-inner{
    max-width:800px;
    margin:auto;
}

.ss-about-cta h2{
    margin:0;
    font-size:clamp(38px,5vw,58px);
    line-height:1.05;
    letter-spacing:-.045em;
}

.ss-about-cta p{
    max-width:600px;
    margin:17px auto 28px;
    color:var(--ab-muted);
    font-size:14px;
    line-height:1.8;
}

.ss-about-cta .ss-about-btn{
    margin:auto;
}


/* =========================================================
   RESPONSIVE
   ========================================================= */

@media(max-width:1050px){

    .ss-about-wrap{
        width:min(var(--ab-wrap),calc(100% - 34px));
    }

    .ss-about-hero-grid{
        grid-template-columns:1fr;
        gap:35px;
    }

    .ss-about-hero-copy{
        text-align:center;
        max-width:780px;
        margin:auto;
    }

    .ss-about-hero-copy>p{
        margin-left:auto;
        margin-right:auto;
    }

    .ss-about-hero-buttons{
        justify-content:center;
    }

    .ss-about-visual{
        max-width:620px;
        width:100%;
        margin:auto;
    }

    .ss-about-story-grid{
        grid-template-columns:1fr;
        gap:40px;
    }

    .ss-about-story-side{
        position:static;
    }

    .ss-about-values-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .ss-about-stats-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .ss-about-stat:nth-child(2){
        border-right:0;
    }

    .ss-about-stat:nth-child(-n+2){
        border-bottom:1px solid #e9eef5;
    }

    .ss-about-difference-box{
        padding:45px;
    }
}


@media(max-width:800px){

    .ss-about-wrap{
        width:calc(100% - 28px);
    }

    .ss-about-hero{
        min-height:auto;
        padding:65px 0 75px;
    }

    .ss-about-hero h1{
        font-size:clamp(32px,8.5vw,48px);
        line-height:1.05;
    }

    .ss-about-hero-copy>p{
        font-size:14px;
    }

    .ss-about-story,
    .ss-about-values,
    .ss-about-journey,
    .ss-about-difference,
    .ss-about-cta{
        padding:70px 0;
    }

    .ss-about-values-grid{
        grid-template-columns:1fr;
    }

    .ss-about-stats-grid{
        grid-template-columns:1fr 1fr;
    }

    .ss-about-stat{
        padding:18px 13px;
    }

    .ss-about-difference-box{
        grid-template-columns:1fr;
        gap:35px;
        padding:38px 28px;
    }

    .ss-about-difference-list{
        grid-template-columns:1fr 1fr;
    }

    .ss-about-timeline:before{
        left:24px;
    }

    .ss-about-timeline-item,
    .ss-about-timeline-item:nth-child(even){
        width:100%;
        margin-left:0;
        padding:0 0 30px 58px;
    }

    .ss-about-timeline-dot,
    .ss-about-timeline-item:nth-child(even) .ss-about-timeline-dot{
        left:17px;
        right:auto;
    }
}


@media(max-width:600px){

    .ss-about-wrap{
        width:calc(100% - 24px);
    }

    .ss-about-hero{
        padding:45px 0 60px;
    }

    .ss-about-hero h1{
        font-size:clamp(38px,11vw,49px);
    }

    .ss-about-hero-buttons{
        flex-direction:column;
        max-width:330px;
        margin:27px auto 0;
    }

    .ss-about-hero-buttons .ss-about-btn{
        width:100%;
    }

    .ss-about-visual{
        min-height:350px;
        margin-top:5px;
    }

    .ss-about-visual:before,
    .ss-about-ring{
        width:315px;
        height:315px;
    }

    .ss-about-core{
        width:88%;
        min-height:250px;
        padding:20px;
    }

    .ss-about-core-title{
        font-size:23px;
    }

    .ss-about-floating{
        padding:9px 11px;
    }

    .ss-about-floating strong{
        font-size:15px;
    }

    .ss-about-float-a{
        left:0;
        top:13%;
    }

    .ss-about-float-b{
        right:0;
        bottom:10%;
    }

    .ss-about-story-side h2,
    .ss-about-section-head h2,
    .ss-about-journey-head h2{
        font-size:33px;
    }

    .ss-about-story-copy p:first-child{
        font-size:16px;
    }

    .ss-about-stats{
        padding-bottom:65px;
    }

    .ss-about-stats-grid{
        gap:0;
        padding:5px;
    }

    .ss-about-stat{
        grid-template-columns:38px minmax(0,1fr);
        gap:9px;
        padding:15px 8px;
    }

    .ss-about-stat-icon{
        width:38px;
        height:38px;
        border-radius:11px;
    }

    .ss-about-stat strong{
        font-size:20px;
    }

    .ss-about-stat span{
        font-size:8px;
    }

    .ss-about-difference-list{
        grid-template-columns:1fr;
    }

    .ss-about-difference-box{
        padding:32px 22px;
        border-radius:20px;
    }

    .ss-about-difference-copy h2{
        font-size:32px;
    }

    .ss-about-cta h2{
        font-size:34px;
    }
}


@media(prefers-reduced-motion:reduce){

    .ss-about *,
    .ss-about *:before,
    .ss-about *:after{
        animation-duration:.001ms!important;
        animation-iteration-count:1!important;
        transition-duration:.001ms!important;
        scroll-behavior:auto!important;
    }
}
</style>


<div class="ss-about tw-site">

    <!-- =====================================================
         HERO
         ===================================================== -->

    <section class="ss-about-hero">

        <div class="ss-about-hero-bg" aria-hidden="true">
            <span class="ss-about-grid-lines"></span>
            <span class="ss-about-beam"></span>
            <span class="ss-about-orb ss-about-orb-a"></span>
            <span class="ss-about-orb ss-about-orb-b"></span>
        </div>

        <div class="ss-about-wrap ss-about-hero-grid">

            <div class="ss-about-hero-copy ss-about-reveal">

                <span class="ss-about-kicker">
                    <i class="fas fa-compass"></i>
                    Who We Are
                </span>

                <h1>
                    We Turn
                    <span class="ss-about-blue">Ideas</span>
                    Into Digital
                    <span class="ss-about-blue">Growth.</span>
                </h1>

                <p>
                    ScaleSphere is a digital solutions partner helping businesses
                    turn ambitious ideas into powerful products, meaningful
                    experiences and measurable growth.
                </p>

                <div class="ss-about-hero-buttons">

                    <a href="/contact" class="ss-about-btn ss-about-btn-fill">
                        Work With Us
                        <i class="fas fa-arrow-right"></i>
                    </a>

                    <a href="#ss-about-story" class="ss-about-btn ss-about-btn-line">
                        Our Story
                    </a>

                </div>

            </div>


            <!-- HERO VISUAL -->

            <div class="ss-about-visual ss-about-reveal ss-about-delay-2">

                <span class="ss-about-ring" aria-hidden="true"></span>

                <div class="ss-about-core">

                    <div class="ss-about-core-top">

                        <div class="ss-about-core-brand">
                            <span class="ss-about-core-brand-mark">
                                <i class="fas fa-layer-group"></i>
                            </span>

                            <strong>ScaleSphere</strong>
                        </div>

                        <span class="ss-about-status">
                            <i></i>
                            Growing Together
                        </span>

                    </div>


                    <div class="ss-about-core-title">
                        Digital products
                        built for
                        <span class="ss-about-blue">growth.</span>
                    </div>

                    <div class="ss-about-core-text">
                        Strategy, design, technology and marketing
                        working together around one clear goal.
                    </div>


                    <div class="ss-about-progress">

                        <div class="ss-about-progress-row">
                            <span>Digital Growth</span>
                            <strong>86%</strong>
                        </div>

                        <div class="ss-about-progress-bar">
                            <span></span>
                        </div>

                    </div>


                    <div class="ss-about-core-footer">

                        <div class="ss-about-mini">
                            <small>Projects</small>
                            <strong>120+</strong>
                        </div>

                        <div class="ss-about-mini">
                            <small>Retention</small>
                            <strong>98%</strong>
                        </div>

                        <div class="ss-about-mini">
                            <small>Specialists</small>
                            <strong>40+</strong>
                        </div>

                    </div>

                </div>


                <div class="ss-about-floating ss-about-float-a">
                    <small>Experience</small>
                    <strong>5+ Years</strong>
                </div>

                <div class="ss-about-floating ss-about-float-b">
                    <small>Client Growth</small>
                    <strong>↗ +42%</strong>
                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         STORY
         ===================================================== -->

    <section class="ss-about-story" id="ss-about-story">

        <div class="ss-about-wrap ss-about-story-grid">

            <div class="ss-about-story-side ss-about-reveal">

                <span class="ss-about-label">
                    Our Story
                </span>

                <h2>
                    Built Around
                    <span class="ss-about-blue">
                        Better Ideas.
                    </span>
                </h2>

                <div class="ss-about-highlight">

                    <div class="ss-about-highlight-icon">
                        <i class="fas fa-quote-left"></i>
                    </div>

                    <strong>
                        Technology should create progress.
                    </strong>

                    <span>
                        We believe great digital experiences should
                        make businesses simpler, stronger and ready
                        for what comes next.
                    </span>

                </div>

            </div>


            <div class="ss-about-story-copy ss-about-reveal ss-about-delay-2">

                <p>
                    Businesses today need more than just a website or an app.
                    They need digital experiences that connect with people,
                    solve real problems and support long-term growth.
                </p>

                <p>
                    That is where ScaleSphere comes in. We bring strategy,
                    design, development and digital marketing together under
                    one roof so ideas can move from concept to execution
                    without unnecessary complexity.
                </p>

                <p>
                    Our approach is collaborative from day one. We listen,
                    understand the bigger picture, challenge assumptions
                    where necessary and then build solutions around the
                    outcomes that matter.
                </p>

                <p>
                    Whether it is a new digital product, a business website,
                    mobile application, online marketing campaign or a
                    complete digital transformation, our goal remains the same:
                    create something useful, scalable and built to last.
                </p>

            </div>

        </div>

    </section>


    <!-- =====================================================
         STATS
         ===================================================== -->

    <section class="ss-about-stats">

        <div class="ss-about-wrap">

            <div class="ss-about-stats-grid ss-about-reveal">

                <?php foreach ($aboutStats as $stat): ?>

                    <div class="ss-about-stat ss-about-stat-<?= ts_h($stat["tone"]) ?>">

                        <span class="ss-about-stat-icon">
                            <i class="fas <?= ts_h($stat["icon"]) ?>"></i>
                        </span>

                        <div>
                            <strong
                                class="ss-about-counter"
                                data-target="<?= (int)$stat["target"] ?>"
                                data-original="<?= ts_h($stat["value"]) ?>"
                            >
                                <?= ts_h($stat["value"]) ?>
                            </strong>

                            <span>
                                <?= ts_h($stat["label"]) ?>
                            </span>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- =====================================================
         VALUES
         ===================================================== -->

    <section class="ss-about-values">

        <div class="ss-about-wrap">

            <div class="ss-about-section-head ss-about-reveal">

                <span class="ss-about-label">
                    What We Believe
                </span>

                <h2>
                    The Principles Behind
                    <span class="ss-about-blue">
                        Our Work.
                    </span>
                </h2>

                <p>
                    Good work comes from strong principles. These are the
                    values that guide how we think, collaborate and build.
                </p>

            </div>


            <div class="ss-about-values-grid">

                <?php foreach ($values as $i => $value): ?>

                    <article
                        class="ss-about-value ss-about-reveal ss-about-delay-<?= min($i + 1, 4) ?>"
                    >

                        <span class="ss-about-value-number">
                            <?= str_pad((string)($i + 1), 2, "0", STR_PAD_LEFT) ?>
                        </span>

                        <div class="ss-about-value-icon">
                            <i class="fas <?= ts_h($value["icon"]) ?>"></i>
                        </div>

                        <h3>
                            <?= ts_h($value["title"]) ?>
                        </h3>

                        <p>
                            <?= ts_h($value["desc"]) ?>
                        </p>

                        <span
                            class="ss-about-value-glow"
                            aria-hidden="true"
                        ></span>

                    </article>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- =====================================================
         JOURNEY
         ===================================================== -->

    <section class="ss-about-journey">

        <div class="ss-about-wrap">

            <div class="ss-about-journey-head ss-about-reveal">

                <span class="ss-about-label">
                    How We Work
                </span>

                <h2>
                    From First
                    <span class="ss-about-blue">
                        Conversation
                    </span>
                    To Growth.
                </h2>

                <p>
                    A simple, transparent process designed to keep every
                    project moving in the right direction.
                </p>

            </div>


            <div class="ss-about-timeline">

                <?php foreach ($journey as $i => $item): ?>

                    <div
                        class="ss-about-timeline-item ss-about-reveal ss-about-delay-<?= min($i + 1, 4) ?>"
                    >

                        <span
                            class="ss-about-timeline-dot"
                            aria-hidden="true"
                        ></span>

                        <div class="ss-about-timeline-card">

                            <span class="ss-about-timeline-year">
                                <?= ts_h($item["year"]) ?>
                            </span>

                            <h3>
                                <?= ts_h($item["title"]) ?>
                            </h3>

                            <p>
                                <?= ts_h($item["desc"]) ?>
                            </p>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </section>


    <!-- =====================================================
         DIFFERENCE
         ===================================================== -->

    <section class="ss-about-difference">

        <div class="ss-about-wrap">

            <div class="ss-about-difference-box ss-about-reveal">

                <div class="ss-about-difference-copy">

                    <span class="ss-about-label">
                        Why ScaleSphere
                    </span>

                    <h2>
                        More Than A
                        <span style="color:#b9d7ff;">
                            Technology Partner.
                        </span>
                    </h2>

                    <p>
                        We work as an extension of your team — combining
                        business understanding, creative thinking and
                        technical expertise to turn complex challenges
                        into clear digital solutions.
                    </p>

                </div>


                <div class="ss-about-difference-list">

                    <div class="ss-about-difference-item">
                        <i class="fas fa-comments"></i>
                        <strong>Clear Communication</strong>
                        <span>
                            Stay informed from idea to launch.
                        </span>
                    </div>

                    <div class="ss-about-difference-item">
                        <i class="fas fa-bolt"></i>
                        <strong>Agile Execution</strong>
                        <span>
                            Move quickly without sacrificing quality.
                        </span>
                    </div>

                    <div class="ss-about-difference-item">
                        <i class="fas fa-code"></i>
                        <strong>Quality Engineering</strong>
                        <span>
                            Build reliable and scalable solutions.
                        </span>
                    </div>

                    <div class="ss-about-difference-item">
                        <i class="fas fa-chart-line"></i>
                        <strong>Growth Mindset</strong>
                        <span>
                            Every decision connects back to growth.
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </section>


    <!-- =====================================================
         CTA
         ===================================================== -->

    <section class="ss-about-cta">

        <div class="ss-about-wrap">

            <div class="ss-about-cta-inner ss-about-reveal">

                <span class="ss-about-label">
                    Let's Build Together
                </span>

                <h2>
                    Have An Idea?
                    <span class="ss-about-blue">
                        Let's Scale It.
                    </span>
                </h2>

                <p>
                    Tell us what you are building, where you want to go
                    and what is holding you back. We will help you find
                    the right digital path forward.
                </p>

                <a href="/contact" class="ss-about-btn ss-about-btn-fill">
                    Start A Conversation
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

        </div>

    </section>

</div>


<script>
(function(){

    const root = document.querySelector('.ss-about');

    if(!root) return;


    /* =====================================================
       SCROLL REVEAL
       ===================================================== */

    const revealItems =
        root.querySelectorAll('.ss-about-reveal');

    if('IntersectionObserver' in window){

        const observer =
            new IntersectionObserver(
                (entries, obs) => {

                    entries.forEach(entry => {

                        if(entry.isIntersecting){

                            entry.target.classList.add(
                                'ss-about-visible'
                            );

                            obs.unobserve(entry.target);
                        }

                    });

                },
                {
                    threshold:.12,
                    rootMargin:'0px 0px -35px 0px'
                }
            );

        revealItems.forEach(el => {
            observer.observe(el);
        });

    }else{

        revealItems.forEach(el => {
            el.classList.add('ss-about-visible');
        });

    }


    /* =====================================================
       STAT COUNTERS
       ===================================================== */

    const counters =
        root.querySelectorAll('.ss-about-counter');

    let countersDone = false;

    function animateCounters(){

        if(countersDone) return;

        countersDone = true;

        counters.forEach(el => {

            const target =
                parseInt(
                    el.dataset.target || '0',
                    10
                );

            const original =
                el.dataset.original || '';

            if(!target) return;

            const suffix =
                original.replace(/[0-9]/g,'');

            const duration = 1300;

            const start =
                performance.now();

            function tick(now){

                const progress =
                    Math.min(
                        (now - start) / duration,
                        1
                    );

                const eased =
                    1 - Math.pow(
                        1 - progress,
                        3
                    );

                el.textContent =
                    Math.round(
                        target * eased
                    ) + suffix;

                if(progress < 1){

                    requestAnimationFrame(tick);

                }else{

                    el.textContent =
                        original;

                }

            }

            requestAnimationFrame(tick);

        });

    }


    const stats =
        root.querySelector('.ss-about-stats-grid');

    if(stats && 'IntersectionObserver' in window){

        const counterObserver =
            new IntersectionObserver(
                entries => {

                    if(entries[0].isIntersecting){

                        animateCounters();

                        counterObserver.disconnect();
                    }

                },
                {
                    threshold:.25
                }
            );

        counterObserver.observe(stats);

    }


    /* =====================================================
       SUBTLE HERO MOUSE MOVEMENT
       ===================================================== */

    const visual =
        root.querySelector('.ss-about-visual');

    const core =
        root.querySelector('.ss-about-core');

    if(
        visual &&
        core &&
        window.matchMedia('(pointer:fine)').matches
    ){

        visual.addEventListener(
            'mousemove',
            function(e){

                const rect =
                    visual.getBoundingClientRect();

                const x =
                    (e.clientX - rect.left) /
                    rect.width - .5;

                const y =
                    (e.clientY - rect.top) /
                    rect.height - .5;

                core.style.transform =
                    'perspective(900px) ' +
                    'rotateY(' +
                    (x * 3) +
                    'deg) ' +
                    'rotateX(' +
                    (-y * 3) +
                    'deg) ' +
                    'translateY(-5px)';

            }
        );

        visual.addEventListener(
            'mouseleave',
            function(){

                core.style.transform =
                    'translateY(0)';

            }
        );

    }

})();
</script>


<?php

ts_layout(
    "About Us | " . $site["name"],
    ob_get_clean(),
    [
        "description" =>
            $site["name"] .
            " — learn about our approach, values, digital expertise and how we help businesses grow.",
        "path" => "/about-us",
        "bodyClass" => "page-about",
        "jsonld" => [ts_services_jsonld()],
    ]
);

?>