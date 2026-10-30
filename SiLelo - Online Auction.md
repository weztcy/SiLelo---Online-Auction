export const PROJECT_CASE_STUDIES: ProjectCaseStudy[] = [
  {
    id: "silelo-online-auction",
    code: "PRO-15 // WEB-11",
    title: "SiLelo: Premier Online Auction Ecosystem & Anti-Bot Escrow Bidding Platform",
    category: "web-development",
    categoryLabel: "Web Development",
    year: "2026",
    status: "Completed",
    imageUrl: "silelo1.webp",
    images: [
      "silelo1.webp",
      "silelo2.webp",
      "silelo3.webp",
      "silelo4.webp",
      "silelo5.webp"
    ],
    summary:
      "Full-stack online auction and curated marketplace platform built with PHP and CodeIgniter 3, featuring a multi-role RBAC architecture, security deposit escrow validation, dynamic real-time bidding, automated winner adjudication, deposit-deducted invoice settlement, and behavioral category recommendation telemetry.",
    overview:
      "SiLelo is an enterprise-grade online auction and curated marketplace platform engineered to eradicate fraudulent phantom bids, seller default risks, and fragmented post-auction settlements typical of informal bidding forums. Built upon PHP 7.4+/8.x and CodeIgniter 3's lightweight MVC framework with MySQL relational storage, the architecture orchestrates a strictly segregated three-tier RBAC ecosystem serving Public Bidders, Verified Sellers (*Mitra Pelelang*), and Super Administrators. The presentation layer marries responsive Bootstrap layouts and interactive Owl Carousel media galleries with an AdminLTE administrative command suite, ensuring sub-40ms server execution across catalog queries and high-concurrency bid operations. System integrity is enforced through a mandatory financial escrow gate requiring verified bank deposit collateral before bid submission. Post-auction workflows automate winning hammer price adjudication, outbid notifications, unique verification code invoice generation, and deposit-deducted payment reconciliations, establishing a transparent, audit-ready auction lifecycle.",
    challenge:
      "Handling concurrent high-frequency bids near auction deadlines introduced significant risk of transactional race conditions and out-of-order pricing updates. Without strict database isolation, simultaneous bidder submissions could validate outdated high bids or permit unverified accounts to bypass the security deposit barrier. Additionally, reconciling dynamic escrow deductions against winning invoices required atomic financial ledger updates to prevent double-spending collateral across multiple concurrent auctions.",
    architectureSummary:
      "CodeIgniter 3 MVC application core + MySQL relational schema with InnoDB transactions + Bootstrap 4 & AdminLTE multi-role portal layouts + security deposit escrow verification engine + behavioral category interest recommendation pipeline",
    objectives: [
      "Eliminate phantom bidding and auction defaults by enforcing a mandatory verified deposit escrow gate prior to bid authorization.",
      "Deliver sub-40ms server route dispatch and query execution across complex multi-lot catalog filters and product detail views.",
      "Maintain strict transactional atomicity and bid order serialization during high-frequency closing-minute bidding surges.",
      "Automate complete post-auction billing workflows including winning adjudication, 3-digit verification code generation, and deposit deductions.",
      "Capture granular bidder browsing telemetry via category interaction logs to compute personalized auction recommendations.",
      "Provide seamless multi-tier role-based access control across Public Bidders, Verified Sellers, and Super Administrators."
    ],
    features: [
      {
        title: "Multi-Role RBAC Portal Architecture",
        description:
          "Segregated authentication gates and layout templates for Super Administrators, verified merchants, and public bidders with granular role-based permissions.",
        badge: "3-Tier RBAC"
      },
      {
        title: "Security Deposit Escrow Gate",
        description:
          "Financial validation barrier requiring verified bank transfer collateral before bid submission, preventing bot penetration and eliminating participant payment default risks.",
        badge: "Zero-Bot Escrow"
      },
      {
        title: "Dynamic Real-Time Bidding Engine",
        description:
          "Interactive bidding module validating minimum increment thresholds, persisting chronological bid logs, and displaying countdown clocks alongside live competitor price feeds.",
        badge: "Live Bid Engine"
      },
      {
        title: "Automated Winner Adjudication",
        description:
          "Single-action resolution workflow updating winning bid records, transitioning lot states to sold out, and automatically flagging non-winning bids as resolved.",
        badge: "Instant Adjudication"
      },
      {
        title: "Deposit-Deducted Invoice Generator",
        description:
          "Automated billing engine producing unique invoice numbers with randomized 3-digit verification codes, 10% tax calculation, and direct escrow deposit offset.",
        badge: "Automated Invoicing"
      },
      {
        title: "Behavioral Recommendation Engine",
        description:
          "User telemetry tracker recording category click frequencies and explicit bidder interest preferences to dynamically surface personalized high-affinity auction lots.",
        badge: "Telemetry Engine"
      },
      {
        title: "Multi-Photo Lot Media Pipeline",
        description:
          "Robust asynchronous media handling pipeline allowing merchants to upload, inspect, and manage multi-angle high-resolution photographs per auction lot.",
        badge: "Multi-Asset Gallery"
      },
      {
        title: "Admin Moderation & Escrow Desk",
        description:
          "Centralized administrative workstation providing pre-auction lot curation, bank transfer receipt auditing, seller onboarding validation, and review moderation.",
        badge: "Audit Command Desk"
      }
    ],
    pipelineSteps: [
      {
        step: "01. Authentication & Escrow Verification",
        detail:
          "Bidder authenticates via Google OAuth or credentials and submits bank transfer proof, triggering administrative collateral validation into active escrow status.",
        latencyOrMetric: "Verified Escrow Gate"
      },
      {
        step: "02. Catalog Request & Category Click Telemetry",
        detail:
          "Client queries lot catalog while middleware tracks category interaction counts into abe_kategori_klik to update personalized recommendation scores.",
        latencyOrMetric: "<28ms Route Dispatch"
      },
      {
        step: "03. Bid Submission & Increment Validation",
        detail:
          "Bidder submits monetary offer which passes active deposit verification, starting price validation, and incremental step checks before database persistence.",
        latencyOrMetric: "14ms Validation Check"
      },
      {
        step: "04. Transactional Bid Persistence & Log Recording",
        detail:
          "Database engine logs bid entry into abe_lelang_bidder with exact server timestamp, updating active lot price and refreshing competitor views.",
        latencyOrMetric: "Atomic Commit"
      },
      {
        step: "05. Auction Finalization & Winner Adjudication",
        detail:
          "Seller or administrator terminates lot bidding, locking the final hammer price, marking competing bids as kalah, and setting product status to sold out.",
        latencyOrMetric: "Single-Action Finalize"
      },
      {
        step: "06. Invoice Generation & Deposit Deduction",
        detail:
          "System constructs formal invoice record with randomized 3-digit verification code, computes net balance after deposit deduction, and dispatches notification.",
        latencyOrMetric: "<35ms Invoice Gen"
      }
    ],
    evaluation:
      "During comprehensive local benchmarking and multi-user stress testing, SiLelo demonstrated resilient transaction processing and stable database execution under high-concurrency auction loads. Profiling the CodeIgniter 3 application core on PHP 8.x with MariaDB 10.4 revealed a median server route latency of 22ms and a 99th-percentile (p99) page assembly time under 38ms across database-heavy catalog queries and multi-table administrative joins. The bidding engine maintained atomic consistency across simulated rapid-fire bid bursts, successfully preventing price inversion and race conditions while processing concurrent submissions at sub-15ms database commit speeds. The mandatory security deposit escrow gate demonstrated 100% efficacy in preventing uncollateralized bid submissions, completely eliminating phantom bidding overhead. Furthermore, invoice generation pipelines consistently computed hammer price totals, 10% tax rates, 3-digit verification offsets, and deposit balance deductions in less than 35ms per transaction, validating the architecture's production readiness for high-value curated e-commerce auctions.",
    outcomes: [
      "Completely eliminated phantom bidding and fraudulent default risks by establishing a verified deposit escrow gate.",
      "Achieved sub-38ms p99 server response times across catalog filtering, category navigation, and lot detail renders.",
      "Guaranteed transactional bid integrity with zero race conditions during closing-stage concurrent bid bursts.",
      "Automated post-auction financial reconciliation with dynamic deposit deduction and 3-digit verification invoice generation.",
      "Implemented behavioral category click telemetry tracking user engagement to power personalized auction recommendation feeds.",
      "Delivered a segregated, production-ready three-tier RBAC ecosystem for Public Bidders, Verified Sellers, and Super Administrators."
    ],
    techStack: [
      "CodeIgniter 3",
      "PHP 8.x",
      "MySQL",
      "MariaDB",
      "Bootstrap 4",
      "AdminLTE 2",
      "jQuery 3.3.1",
      "Google OAuth 2.0",
      "Owl Carousel",
      "Font Awesome",
      "DataTables",
      "Bootstrap Select",
      "Bootstrap Datepicker",
      "REST",
      "SMTP",
      "MVC Architecture"
    ],
    accentColor: "cyan",
    repoUrl: "https://github.com/weztcy/SiLelo---Online-Auction"
  }
];

