---
title: Viktoras Bezaras · CV
description: CV of Viktoras Bezaras, Engineering Manager in Leipzig. Engineering leadership at LeasingMarkt.de / AutoScout24, former CTO at SportSpar, AI-first development workflows.
---
@extends('_layouts.resume')

@section('title', $page->title)

@section('head_styles')
@parent
<link href="/css/cv-fonts.css" rel="stylesheet">
<style>
  /* Colors */
  :root {
    --c-bg:      #F0F1F5;
    --c-heading: #2D3348;
    --c-accent:  #5575B5;
    --c-contact: #636A7D;
    --c-divider: #CDCFD8;
    --c-border:  #D3D5DE;
    --c-desc:    #616878;
    --c-profile: #454C5F;
    --c-body:    #4A5163;
    --c-muted:   #787F92;
    --c-subtle:  #6D7485;
  }

  * { box-sizing: border-box; }
  body { margin: 0; background: var(--c-bg); }

  /* Layout */
  .cv2-stack { display: flex; flex-direction: column; align-items: center; gap: 34px; padding: 44px 24px; min-height: 100vh; }
  .cv2-pg    { width: 794px; min-height: 1123px; background: #fff; box-shadow: 0 2px 12px rgba(20,22,28,0.16); }
  .cv2-inner { padding: 50px 54px; position: relative; }
  .cv2-row   { display: flex; justify-content: space-between; align-items: baseline; gap: 14px; }
  .cv2-col   { display: flex; flex-direction: column; }

  /* Page 1 header */
  .cv2-name       { font-weight: 500; font-size: 48px; line-height: 1.0; letter-spacing: 0.004em; color: var(--c-heading); margin: 0; }
  .cv2-accent-bar { width: 50px; height: 3px; background: var(--c-accent); margin: 15px 0 14px; }
  .cv2-contact    { font-family: 'IBM Plex Sans', sans-serif; font-size: 11.5px; color: var(--c-contact); line-height: 1.7; }
  .cv2-contact a  { color: inherit; }
  .cv2-divider    { height: 1px; background: var(--c-divider); margin: 24px 0 22px; }
  .cv2-profile    { font-size: 16.5px; line-height: 1.5; color: var(--c-profile); margin: 0 0 30px; }

  /* Page 2 header */
  .cv2-pg2-header { margin-bottom: 26px; }
  .cv2-pg-name    { font-family: 'Newsreader', serif; font-weight: 500; font-size: 20px; color: var(--c-heading); }
  .cv2-pg-num     { font-family: 'IBM Plex Mono', monospace; font-size: 10px; color: var(--c-subtle); }

  /* Section headers */
  .cv2-sechead       { display: flex; align-items: center; gap: 14px; }
  .cv2-sechead-exp   { margin-bottom: 20px; }
  .cv2-sechead-edu   { margin: 30px 0 18px; }
  .cv2-sechead-lang  { margin-bottom: 13px; }
  .cv2-sectitle      { font-family: 'Newsreader', serif; font-weight: 600; font-size: 13px; letter-spacing: 0.1em; text-transform: uppercase; color: var(--c-accent); white-space: nowrap; }
  .cv2-secline       { flex: 1; height: 1px; background: var(--c-border); }

  /* Typography */
  .cv2-sans { font-family: 'IBM Plex Sans', sans-serif; }
  .cv2-mono { font-family: 'IBM Plex Mono', monospace; }
  .cv2-iser { font-family: 'Newsreader', serif; font-style: italic; font-weight: 400; font-synthesis: none; }

  /* Job entries */
  .cv2-jobs         { gap: 22px; }
  .cv2-jobs-sm      { gap: 18px; }
  .cv2-job-title    { font-family: 'IBM Plex Sans', sans-serif; font-weight: 600; font-size: 15px; color: var(--c-heading); }
  .cv2-job-title-sm { font-family: 'IBM Plex Sans', sans-serif; font-weight: 600; font-size: 14px; color: var(--c-heading); }
  .cv2-date         { font-family: 'IBM Plex Mono', monospace; font-size: 10.5px; color: var(--c-accent); white-space: nowrap; }
  .cv2-date-sm      { font-size: 10px; }
  .cv2-desc         { font-size: 13px; color: var(--c-desc); line-height: 1.45; margin: 3px 0 9px; }
  .cv2-desc-sm      { font-size: 13px; color: var(--c-desc); line-height: 1.45; margin: 3px 0 8px; }
  .cv2-subline      { font-family: 'IBM Plex Sans', sans-serif; font-size: 12px; color: var(--c-desc); margin: 3px 0 0; }
  .cv2-subline + .cv2-desc { margin-top: 9px; }
  .cv2-accent-dot   { color: var(--c-accent); }

  /* Bullets */
  .cv2-bullets       { margin: 0; padding: 0; list-style: none; display: flex; flex-direction: column; gap: 5px; }
  .cv2-bullet        { font-family: 'IBM Plex Sans', sans-serif; font-size: 12px; line-height: 1.45; color: var(--c-body); padding-left: 16px; position: relative; }
  .cv2-bullet-marker { position: absolute; left: 0; top: 0; color: var(--c-accent); }

  /* Chips */
  .cv2-chips        { display: flex; flex-wrap: wrap; gap: 5px; margin-top: 10px; }
  .cv2-chips-no-top  { margin-top: 0; }
  .cv2-chips-row2    { margin-top: 4px; }
  .cv2-chip         { font-family: 'IBM Plex Mono', monospace; font-size: 9.5px; color: var(--c-desc); background: var(--c-bg); padding: 2px 7px; border-radius: 3px; }

  /* Education */
  .cv2-edu-list  { gap: 13px; }
  .cv2-edu-title { font-family: 'IBM Plex Sans', sans-serif; font-weight: 600; font-size: 13.5px; color: var(--c-heading); }
  .cv2-edu-desc  { font-size: 13px; color: var(--c-desc); margin-top: 2px; }

  /* Languages */
  .cv2-lang-section { margin-top: 32px; }
  .cv2-lang-list    { display: flex; gap: 40px; }
  .cv2-lang-item    { display: flex; gap: 6px; align-items: baseline; }
  .cv2-lang-level   { font-size: 13px; color: var(--c-desc); }

  /* Photo */
  .cv2-photo-wrap { width: 147px; height: 130px; overflow: hidden; position: absolute; top: 32px; right: 54px; }
  .cv2-photo      { width: 100%; height: 100%; object-fit: cover; object-position: center 0; }

  /* Small screens */
  @media screen and (max-width: 840px) {
    .cv2-stack      { padding: 0; gap: 12px; }
    .cv2-pg         { width: 100%; min-height: 0; box-shadow: none; }
    .cv2-inner      { padding: 28px 20px; }
    .cv2-photo-wrap { position: static; width: 110px; height: 97px; margin-bottom: 18px; }
    .cv2-name       { font-size: 36px; }
    .cv2-profile    { font-size: 15.5px; }
    .cv2-row        { flex-wrap: wrap; gap: 2px 14px; }
    .cv2-lang-list  { flex-wrap: wrap; gap: 8px 24px; }
  }

  /* Print */
  @page { size: A4; margin: 0; }
  @media print {
    body       { background: #fff; }
    .cv2-stack { padding: 0; gap: 0; background: #fff; min-height: 0; }
    .cv2-pg    { box-shadow: none; min-height: 0; break-after: page; }
    .cv2-pg:last-child { break-after: auto; }
  }
</style>
@endsection

@section('contents')
<div class="cv2-stack">

  <!-- PAGE 1 -->
  <div class="cv2-pg">
    <div class="cv2-inner">

      <div class="cv2-photo-wrap">
        <picture>
          <source srcset="/img/viktoras_8.avif" type="image/avif" />
          <img src="/img/viktoras_8.jpg" class="cv2-photo" decoding="async" loading="lazy" alt="Viktoras Bezaras" />
        </picture>
      </div>
      <h1 class="cv2-iser cv2-name">Viktoras Bezaras</h1>
      <div class="cv2-accent-bar"></div>
      <div class="cv2-contact">mail@viktoras.de&nbsp;&nbsp;·&nbsp;&nbsp;Leipzig, Germany&nbsp;&nbsp;·&nbsp;&nbsp;<a href="https://viktoras.de">viktoras.de</a>&nbsp;&nbsp;·&nbsp;&nbsp;<a href="https://github.com/viktoras25">github.com/viktoras25</a>&nbsp;&nbsp;·&nbsp;&nbsp;<a href="https://www.linkedin.com/in/vkts/">linkedin.com/in/vkts</a></div>
      <div class="cv2-divider"></div>
      <p class="cv2-iser cv2-profile">Software engineer who grew into engineering management without leaving the code behind. I find what's broken and fix it: an oversized AWS bill, slow agile processes, an underperforming team. I work leader-leader built on trust, with engineers who fully own their domains.</p>

      <div class="cv2-sechead cv2-sechead-exp"><span class="cv2-sectitle">Experience</span><span class="cv2-secline"></span></div>

      <div class="cv2-col cv2-jobs">

        <!-- AutoScout24 -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title">Engineering Manager <span class="cv2-accent-dot">·</span> LeasingMarkt.de / AutoScout24</div>
            <div class="cv2-date">03/2022 - now</div>
          </div>
          <div class="cv2-subline">Engineering Manager <span class="cv2-accent-dot">·</span> 2024–now <span class="cv2-accent-dot">·</span> 7 developers (role resized in the post-acquisition restructuring)</div>
          <div class="cv2-subline">Head of Development <span class="cv2-accent-dot">·</span> 2022–2024 <span class="cv2-accent-dot">·</span> 15 developers, 4 teams</div>
          <div class="cv2-iser cv2-desc">Düsseldorf - LeasingMarkt GmbH is a car leasing marketplace with 2M+ monthly visitors, acquired by AutoScout24 Group.</div>
          <ul class="cv2-bullets">
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Built an agentic development suite (Claude, Codex) with agents, skills, and AI-first workflows; adopted by my team and picked up by neighbouring teams</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Co-delivered the on-prem → AWS migration in 3 months, then cut AWS spend by ~80%</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Migrated engineering org to GitHub and re-architected CI/CD pipelines</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Raised team throughput from ~20–25 to ~45–50 story points per sprint within about six months in 2026, with the same team size, by redesigning agile workflows and introducing AI-assisted development (Claude Code, Codex)</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Owned the full performance management cycle: 1:1s, reviews, PIPs, exits</li>
          </ul>
          <div class="cv2-chips">
            <span class="cv2-chip">People Management</span><span class="cv2-chip">Hiring</span><span class="cv2-chip">Performance Management</span><span class="cv2-chip">Team Leadership</span><span class="cv2-chip">Stakeholder Management</span>
          </div>
          <div class="cv2-chips cv2-chips-row2">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">Laravel</span><span class="cv2-chip">Node.js</span><span class="cv2-chip">AWS</span><span class="cv2-chip">RDS</span><span class="cv2-chip">CDK</span><span class="cv2-chip">Claude Code</span><span class="cv2-chip">MariaDB</span><span class="cv2-chip">Agile</span><span class="cv2-chip">GitHub Actions</span><span class="cv2-chip">GitHub</span><span class="cv2-chip">Codex</span>
          </div>
        </div>

        <!-- SportSpar -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title">CTO <span class="cv2-accent-dot">·</span> SportSpar</div>
            <div class="cv2-date">07/2019 - 03/2022</div>
          </div>
          <div class="cv2-subline">Hands-on CTO <span class="cv2-accent-dot">·</span> 2019–2022 <span class="cv2-accent-dot">·</span> 7 developers, 2 teams</div>
          <div class="cv2-iser cv2-desc">Leipzig - SportSpar is an online outlet for discounted sportswear and equipment, processing thousands of orders per day across multiple European markets.</div>
          <ul class="cv2-bullets">
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Grew the team from 2 to 7 developers while owning all engineering</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Substantially rebuilt a poorly built internal PMS: architecture, infrastructure, test coverage, message queue</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Established team-oriented agile development processes</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Introduced quality standards and automated them via CI/CD processes</li>
          </ul>
          <div class="cv2-chips">
            <span class="cv2-chip">People Management</span><span class="cv2-chip">Hiring</span><span class="cv2-chip">Team Leadership</span>
          </div>
          <div class="cv2-chips cv2-chips-row2">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">MariaDB</span><span class="cv2-chip">Laravel</span><span class="cv2-chip">RabbitMQ</span><span class="cv2-chip">PHPUnit</span><span class="cv2-chip">Agile</span><span class="cv2-chip">Redis</span><span class="cv2-chip">Gitlab CI/CD</span><span class="cv2-chip">Youtrack</span><span class="cv2-chip">Ansible</span>
          </div>
        </div>

        <!-- TraSo -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title">Integrations Lead / Developer <span class="cv2-accent-dot">·</span> TraSo</div>
            <div class="cv2-date">05/2014 - 06/2019</div>
          </div>
          <div class="cv2-iser cv2-desc">Leipzig - TraSo GmbH builds backend software for tour operators to place billions of travel offers on the market every day.</div>
          <ul class="cv2-bullets">
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Hired for hotel-data imports; took over and rewrote a slow, unreliable import module, with thousands of unit tests</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Tripled the number of connected third-party services/APIs</li>
            <li class="cv2-bullet"><span class="cv2-bullet-marker">-</span>Took over further domains: booking and transfer interfaces, OTDS export</li>
          </ul>
          <div class="cv2-chips">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">MySQL</span><span class="cv2-chip">Zend Framework</span><span class="cv2-chip">PHPUnit</span><span class="cv2-chip">Git</span><span class="cv2-chip">Jira</span><span class="cv2-chip">Stash</span><span class="cv2-chip">Bamboo</span><span class="cv2-chip">GitLab</span>
          </div>
        </div>

      </div>
    </div>
  </div>

  <!-- PAGE 2 -->
  <div class="cv2-pg">
    <div class="cv2-inner">

      <div class="cv2-row cv2-pg2-header">
        <div class="cv2-pg-name">Viktoras Bezaras</div>
        <div class="cv2-pg-num">Page 2 / 2</div>
      </div>

      <div class="cv2-sechead cv2-sechead-exp"><span class="cv2-sectitle">Experience - continued</span><span class="cv2-secline"></span></div>

      <div class="cv2-col cv2-jobs-sm">

        <!-- meets-ecommerce -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title-sm">Senior Developer <span class="cv2-accent-dot">·</span> meets-ecommerce</div>
            <div class="cv2-date">06/2013 - 05/2014</div>
          </div>
          <div class="cv2-iser cv2-desc-sm">Niesky - Designed and developed a microservice-based e-commerce management system with integrations to Magento and other sales platforms.</div>
          <div class="cv2-chips cv2-chips-no-top">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">Phalcon Framework</span><span class="cv2-chip">RabbitMQ</span><span class="cv2-chip">PostgreSQL</span><span class="cv2-chip">Git</span><span class="cv2-chip">Robot Framework</span><span class="cv2-chip">Scrum</span>
          </div>
        </div>

        <!-- netforge -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title-sm">PHP Developer <span class="cv2-accent-dot">·</span> netforge</div>
            <div class="cv2-date">01/2011 - 04/2013</div>
          </div>
          <div class="cv2-iser cv2-desc-sm">Berlin - Online dating platform. Sole developer responsible for building a full accounting management system from scratch (Symfony/Doctrine), plus advertising modules and multi-tenancy features. Worked 100% remotely and independently.</div>
          <div class="cv2-chips cv2-chips-no-top">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">MySQL</span><span class="cv2-chip">SQLite</span><span class="cv2-chip">Symfony Framework</span><span class="cv2-chip">Doctrine</span><span class="cv2-chip">Lime</span><span class="cv2-chip">SVN</span><span class="cv2-chip">Bootstrap</span>
          </div>
        </div>

        <!-- WEB-SHOP-HOSTING -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title-sm">PHP Developer <span class="cv2-accent-dot">·</span> WEB-SHOP-HOSTING</div>
            <div class="cv2-date">03/2010 - 12/2010</div>
          </div>
          <div class="cv2-iser cv2-desc-sm">Berlin - Online agency for shop hosting and website development. Developed a Symfony-based CMS and a Drupal website for Teamdrive GmbH.</div>
          <div class="cv2-chips cv2-chips-no-top">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">Symfony</span><span class="cv2-chip">Nginx</span><span class="cv2-chip">MySQL</span><span class="cv2-chip">Drupal 7</span><span class="cv2-chip">Mercurial</span>
          </div>
        </div>

        <!-- RedFortress -->
        <div>
          <div class="cv2-row">
            <div class="cv2-job-title-sm">PHP Developer <span class="cv2-accent-dot">·</span> RedFortress</div>
            <div class="cv2-date">07/2008 - 03/2010</div>
          </div>
          <div class="cv2-iser cv2-desc-sm">Saint Petersburg - SEO and web development agency. Developed and maintained food delivery websites and internal tools for SEO.</div>
          <div class="cv2-chips cv2-chips-no-top">
            <span class="cv2-chip">PHP</span><span class="cv2-chip">Symfony</span><span class="cv2-chip">Apache</span><span class="cv2-chip">CSS</span><span class="cv2-chip">MySQL</span><span class="cv2-chip">Javascript</span>
          </div>
        </div>

      </div>

      <div class="cv2-lang-section">
        <div class="cv2-sechead cv2-sechead-lang"><span class="cv2-sectitle">Languages</span><span class="cv2-secline"></span></div>
        <div class="cv2-lang-list">
          <div class="cv2-lang-item"><span class="cv2-edu-title">English</span><span class="cv2-iser cv2-lang-level">fluent</span></div>
          <div class="cv2-lang-item"><span class="cv2-edu-title">German</span><span class="cv2-iser cv2-lang-level">fluent</span></div>
          <div class="cv2-lang-item"><span class="cv2-edu-title">Russian</span><span class="cv2-iser cv2-lang-level">native</span></div>
          <div class="cv2-lang-item"><span class="cv2-edu-title">Spanish</span><span class="cv2-iser cv2-lang-level">basic</span></div>
        </div>
      </div>

      <div class="cv2-sechead cv2-sechead-edu"><span class="cv2-sectitle">Education</span><span class="cv2-secline"></span></div>
      <div class="cv2-edu-title">Engineer (Specialist diploma, 5-year programme) in Information Systems and Technologies <span class="cv2-accent-dot">·</span> <span class="cv2-iser cv2-edu-desc">State University for Waterways Communications, Saint Petersburg</span></div>

    </div>
  </div>

</div>
@endsection
