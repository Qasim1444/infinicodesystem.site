<?php

return [
    'blogCategories' => [
        0 => 'All',
        1 => 'Web Development',
        2 => 'WordPress',
        3 => 'AI & Automation',
        4 => 'Python',
        5 => 'MERN Stack',
        6 => 'UI/UX',
        7 => 'Career',
        8 => 'Technology',
        9 => 'Company News',
    ],
    'featuredPost' => [
        'slug' => 'building-scalable-web-apps',
        'title' => 'How We Build Web Apps That Scale From Day One',
        'category' => 'Web Development',
        'excerpt' => 'Architecture decisions you make early quietly define how far your product can grow. Here is the checklist we run before writing code.',
        'image' => '/storage/images/blog-featured-1-1.webp',
        'author' => 'Javed Iqbal',
        'authorRole' => 'Founder / Software Architect',
        'date' => '2026-07-28',
        'readTime' => 7,
        'featured' => true,
        'body' => [
            0 => [
                'type' => 'p',
                'text' => 'Most scaling problems arenâ€™t caused by traffic â€” theyâ€™re caused by decisions made in the first two weeks, long before anyone worried about load. A rushed data model or a tangle of business logic in the UI will slow a team down far sooner than a spike in users ever will.',
            ],
            1 => [
                'type' => 'p',
                'text' => 'Here is the short checklist we run through before writing a single line of production code on a new web application.',
            ],
            2 => [
                'type' => 'h2',
                'text' => 'Start with the data model, not the screens',
            ],
            3 => [
                'type' => 'p',
                'text' => 'Itâ€™s tempting to open a design tool and start on the dashboard. We start with the entities instead: what are the core objects, how do they relate, and which relationships will change most often? A clear, normalized model early on saves painful migrations later.',
            ],
            4 => [
                'type' => 'h2',
                'text' => 'Choose boring, proven technology',
            ],
            5 => [
                'type' => 'p',
                'text' => 'The newest framework is rarely the right bet for something youâ€™ll maintain for years. We default to mature, well-documented tools with large communities, and only reach for something newer when it solves a problem the boring option genuinely canâ€™t.',
            ],
            6 => [
                'type' => 'h2',
                'text' => 'Design for observability from the first commit',
            ],
            7 => [
                'type' => 'p',
                'text' => 'You canâ€™t fix what you canâ€™t see. Structured logging, request tracing and basic metrics cost very little to add at the start and are enormously expensive to retrofit once the app is live and misbehaving.',
            ],
            8 => [
                'type' => 'ul',
                'items' => [
                    0 => 'A single, well-defined source of truth for each entity',
                    1 => 'Clear boundaries between UI, business logic and data access',
                    2 => 'Automated tests around the riskiest logic, not everything',
                    3 => 'A deployment pipeline that anyone on the team can trigger',
                ],
            ],
            9 => [
                'type' => 'quote',
                'text' => 'Scalability is mostly a byproduct of clarity. Systems that are easy to understand tend to be easy to grow.',
            ],
            10 => [
                'type' => 'p',
                'text' => 'None of this is glamorous, and thatâ€™s the point. The teams whose products scale smoothly are usually the ones who were slightly boring and disciplined at the very beginning.',
            ],
        ],
    ],
    'posts' => [
        0 => [
            'slug' => 'building-scalable-web-apps',
            'title' => 'How We Build Web Apps That Scale From Day One',
            'category' => 'Web Development',
            'excerpt' => 'Architecture decisions you make early quietly define how far your product can grow. Here is the checklist we run before writing code.',
            'image' => '/storage/images/blog-featured-1-1.webp',
            'author' => 'Javed Iqbal',
            'authorRole' => 'Founder / Software Architect',
            'date' => '2026-07-28',
            'readTime' => 7,
            'featured' => true,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Most scaling problems arenâ€™t caused by traffic â€” theyâ€™re caused by decisions made in the first two weeks, long before anyone worried about load. A rushed data model or a tangle of business logic in the UI will slow a team down far sooner than a spike in users ever will.',
                ],
                1 => [
                    'type' => 'p',
                    'text' => 'Here is the short checklist we run through before writing a single line of production code on a new web application.',
                ],
                2 => [
                    'type' => 'h2',
                    'text' => 'Start with the data model, not the screens',
                ],
                3 => [
                    'type' => 'p',
                    'text' => 'Itâ€™s tempting to open a design tool and start on the dashboard. We start with the entities instead: what are the core objects, how do they relate, and which relationships will change most often? A clear, normalized model early on saves painful migrations later.',
                ],
                4 => [
                    'type' => 'h2',
                    'text' => 'Choose boring, proven technology',
                ],
                5 => [
                    'type' => 'p',
                    'text' => 'The newest framework is rarely the right bet for something youâ€™ll maintain for years. We default to mature, well-documented tools with large communities, and only reach for something newer when it solves a problem the boring option genuinely canâ€™t.',
                ],
                6 => [
                    'type' => 'h2',
                    'text' => 'Design for observability from the first commit',
                ],
                7 => [
                    'type' => 'p',
                    'text' => 'You canâ€™t fix what you canâ€™t see. Structured logging, request tracing and basic metrics cost very little to add at the start and are enormously expensive to retrofit once the app is live and misbehaving.',
                ],
                8 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'A single, well-defined source of truth for each entity',
                        1 => 'Clear boundaries between UI, business logic and data access',
                        2 => 'Automated tests around the riskiest logic, not everything',
                        3 => 'A deployment pipeline that anyone on the team can trigger',
                    ],
                ],
                9 => [
                    'type' => 'quote',
                    'text' => 'Scalability is mostly a byproduct of clarity. Systems that are easy to understand tend to be easy to grow.',
                ],
                10 => [
                    'type' => 'p',
                    'text' => 'None of this is glamorous, and thatâ€™s the point. The teams whose products scale smoothly are usually the ones who were slightly boring and disciplined at the very beginning.',
                ],
            ],
        ],
        1 => [
            'slug' => 'practical-ai-integration',
            'title' => 'Practical AI Integration: Beyond the Hype',
            'category' => 'AI & Automation',
            'excerpt' => 'Most AI features fail because they solve no real problem. A framework for shipping AI that users actually keep using.',
            'image' => '/storage/images/blog-featured-1-2.webp',
            'author' => 'Qasim Javed',
            'authorRole' => 'Senior Backend Developer',
            'date' => '2026-07-15',
            'readTime' => 9,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Adding â€œAIâ€ to a product is easy. Adding AI that people actually keep using is not. The difference is almost never the model â€” itâ€™s whether the feature is aimed at a real, repeated pain point.',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Start from the job, not the technology',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'Before we integrate anything, we ask: what task is the user doing today that is slow, repetitive or error-prone? If we canâ€™t name that task in one sentence, the feature isnâ€™t ready to build yet.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Ground the model in your own data',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'General models are impressive but generic. The value shows up when you connect them to your own documents, tickets or catalog through retrieval-augmented generation, so answers are specific and verifiable instead of plausible-sounding guesses.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'Design the failure cases',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'AI features fail differently from normal code â€” theyâ€™re confidently wrong. We plan for that: clear â€œIâ€™m not sureâ€ states, easy human handoff, and guardrails that keep the model inside the task it was given.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'A concrete, repeated task the feature accelerates',
                        1 => 'Retrieval grounded in the clientâ€™s real content',
                        2 => 'Visible confidence and graceful fallbacks',
                        3 => 'Cost and latency budgets set before launch',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'The best AI features feel less like magic and more like a very fast, slightly cautious assistant.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'Ship the smallest version that solves one real task well, measure whether people come back to it, and expand from there. That single loop separates useful AI from expensive novelty.',
                ],
            ],
        ],
        2 => [
            'slug' => 'mern-stack-2026',
            'title' => 'The MERN Stack in 2026: Still Worth Learning?',
            'category' => 'MERN Stack',
            'excerpt' => 'The JavaScript ecosystem moves fast. We break down where the MERN stack still shines and how to learn it the smart way.',
            'image' => '/storage/images/blog-featured-1-3.webp',
            'author' => 'Hafiz M. Nadeem',
            'authorRole' => 'MERN Stack Developer',
            'date' => '2026-06-30',
            'readTime' => 6,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Every year someone declares the MERN stack dead, and every year thousands of products keep shipping on it. So where does MongoDB, Express, React and Node.js actually stand in 2026?',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Why it still holds up',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'One language across the whole stack lowers the barrier to full-stack work dramatically. For startups and small teams, being able to move between the API and the UI without switching mental models is a real, measurable advantage.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Where it isnâ€™t the right tool',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'Heavily relational data, strict transactional guarantees, or teams that already live in another ecosystem are all good reasons to look elsewhere. MERN is a strong default, not a universal answer.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'How to learn it without drowning',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'Donâ€™t try to learn all four pieces at once. Get comfortable with JavaScript and React first, then add Node and Express, and only then introduce MongoDB. Build one real project end to end rather than following ten disconnected tutorials.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'Solid JavaScript fundamentals before any framework',
                        1 => 'One full project from database to deployed UI',
                        2 => 'Authentication and deployment â€” the parts tutorials skip',
                        3 => 'Reading other peopleâ€™s code, not just writing your own',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'The stack you finish a real project with beats the â€œperfectâ€ stack you never ship.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'For most people entering web development, MERN remains one of the fastest routes from zero to a working, deployable full-stack app â€” and thatâ€™s exactly why we still teach it.',
                ],
            ],
        ],
        3 => [
            'slug' => 'wordpress-speed-guide',
            'title' => 'Making WordPress Genuinely Fast',
            'category' => 'WordPress',
            'excerpt' => 'A slow WordPress site is a choice, not a fate. The exact steps we take to hit 90+ PageSpeed on client builds.',
            'image' => '/storage/images/project-1-2.webp',
            'author' => 'Muhammad Mujahid',
            'authorRole' => 'WordPress Expert',
            'date' => '2026-06-12',
            'readTime' => 8,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'WordPress has a reputation for being slow. In our experience it isnâ€™t WordPress thatâ€™s slow â€” itâ€™s bloated themes, a pile of overlapping plugins, and unoptimized images. Fix those three and most sites transform.',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Start with the theme',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'A lean, purpose-built theme loads a fraction of the CSS and JavaScript that a do-everything multipurpose theme ships. For client work we almost always build a custom theme rather than fight a bloated one.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Audit every plugin',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'Each plugin is code you didnâ€™t write running on every request. We remove anything that duplicates functionality, and weâ€™re ruthless about plugins that load scripts on pages where theyâ€™re never used.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'Images, caching, and the network',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'Modern image formats, correct sizing, a good caching layer and a CDN do the heavy lifting. Together theyâ€™re usually the difference between a two-second load and an instant one.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'A custom or genuinely lightweight theme',
                        1 => 'Only the plugins that earn their place',
                        2 => 'Next-gen images, sized and lazy-loaded',
                        3 => 'Page caching plus a CDN in front',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'Speed isnâ€™t a plugin you install at the end. Itâ€™s a series of small decisions you make throughout the build.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'Hitting a 90+ performance score on WordPress is very achievable â€” it just requires treating performance as part of the build, not an afterthought.',
                ],
            ],
        ],
        4 => [
            'slug' => 'design-systems-that-last',
            'title' => 'Design Systems That Actually Get Used',
            'category' => 'UI/UX',
            'excerpt' => 'A design system is only valuable if the team reaches for it. How we build systems developers and designers love.',
            'image' => '/storage/images/project-1-3.webp',
            'author' => 'Mubashar Shahzad',
            'authorRole' => 'Frontend Developer',
            'date' => '2026-05-29',
            'readTime' => 5,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Plenty of teams have a design system that nobody uses. It looks beautiful in the design tool and gets quietly ignored the moment thereâ€™s a deadline. A system only pays off when reaching for it is the path of least resistance.',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Build it from real screens',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'We donâ€™t design components in the abstract. We build a few real pages first, notice what repeats, and extract those patterns into the system. Components born from actual needs get used; speculative ones gather dust.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Keep design and code in sync',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'If the design library and the coded components drift apart, trust evaporates. We treat the coded components as the source of truth and make sure the design side reflects whatâ€™s actually shippable.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'Document the â€œwhyâ€, briefly',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'Good documentation isnâ€™t a novel. A short note on when to use a component â€” and when not to â€” prevents most misuse and saves endless back-and-forth in reviews.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'Components extracted from real, shipped screens',
                        1 => 'One source of truth shared by design and code',
                        2 => 'Short, practical usage guidance',
                        3 => 'A low-friction way to propose changes',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'The best design system is the one your team forgets is optional.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'Get those fundamentals right and the system stops being a rulebook people resent â€” it becomes the fastest way to build.',
                ],
            ],
        ],
        5 => [
            'slug' => 'breaking-into-tech',
            'title' => 'Breaking Into Tech: A Realistic Roadmap',
            'category' => 'Career',
            'excerpt' => 'No fluff. The path our Academy graduates actually follow to land their first developer role.',
            'image' => '/storage/images/project-1-4.webp',
            'author' => 'Shahbaz Ahmed',
            'authorRole' => 'Business Analyst',
            'date' => '2026-05-10',
            'readTime' => 7,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Thereâ€™s no shortage of â€œlearn to code in 30 daysâ€ promises online. The reality is slower and far more encouraging: with a steady routine and real projects, a career change into tech is genuinely achievable â€” it just doesnâ€™t happen in a month.',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Pick one path and commit',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'The fastest way to stall is to jump between languages and stacks. Choose one track â€” front-end, full-stack, whatever fits your goals â€” and stay with it long enough to get past the confusing early stage.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Build things you can show',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'Certificates help; a portfolio of real projects helps more. Employers want to see that you can take something from an idea to a working, deployed result. Two or three solid projects beat a dozen half-finished tutorials.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'Learn in public and ask for feedback',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'Share your work, get it reviewed, and act on the feedback. Every graduate weâ€™ve seen succeed did this consistently â€” code review is where beginners turn into professionals.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'One clear learning path, followed to competence',
                        1 => 'A small portfolio of finished, deployed projects',
                        2 => 'Regular code review and honest feedback',
                        3 => 'Consistency over intensity â€” steady beats sporadic',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'You donâ€™t need to be brilliant. You need to be consistent and coachable.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'Itâ€™s a real climb, but a well-worn one. Thousands of people with no technical background have made this exact transition â€” the roadmap is not a secret, it just takes follow-through.',
                ],
            ],
        ],
    ],
    'recentPosts' => [
        0 => [
            'slug' => 'building-scalable-web-apps',
            'title' => 'How We Build Web Apps That Scale From Day One',
            'category' => 'Web Development',
            'excerpt' => 'Architecture decisions you make early quietly define how far your product can grow. Here is the checklist we run before writing code.',
            'image' => '/storage/images/blog-featured-1-1.webp',
            'author' => 'Javed Iqbal',
            'authorRole' => 'Founder / Software Architect',
            'date' => '2026-07-28',
            'readTime' => 7,
            'featured' => true,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Most scaling problems arenâ€™t caused by traffic â€” theyâ€™re caused by decisions made in the first two weeks, long before anyone worried about load. A rushed data model or a tangle of business logic in the UI will slow a team down far sooner than a spike in users ever will.',
                ],
                1 => [
                    'type' => 'p',
                    'text' => 'Here is the short checklist we run through before writing a single line of production code on a new web application.',
                ],
                2 => [
                    'type' => 'h2',
                    'text' => 'Start with the data model, not the screens',
                ],
                3 => [
                    'type' => 'p',
                    'text' => 'Itâ€™s tempting to open a design tool and start on the dashboard. We start with the entities instead: what are the core objects, how do they relate, and which relationships will change most often? A clear, normalized model early on saves painful migrations later.',
                ],
                4 => [
                    'type' => 'h2',
                    'text' => 'Choose boring, proven technology',
                ],
                5 => [
                    'type' => 'p',
                    'text' => 'The newest framework is rarely the right bet for something youâ€™ll maintain for years. We default to mature, well-documented tools with large communities, and only reach for something newer when it solves a problem the boring option genuinely canâ€™t.',
                ],
                6 => [
                    'type' => 'h2',
                    'text' => 'Design for observability from the first commit',
                ],
                7 => [
                    'type' => 'p',
                    'text' => 'You canâ€™t fix what you canâ€™t see. Structured logging, request tracing and basic metrics cost very little to add at the start and are enormously expensive to retrofit once the app is live and misbehaving.',
                ],
                8 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'A single, well-defined source of truth for each entity',
                        1 => 'Clear boundaries between UI, business logic and data access',
                        2 => 'Automated tests around the riskiest logic, not everything',
                        3 => 'A deployment pipeline that anyone on the team can trigger',
                    ],
                ],
                9 => [
                    'type' => 'quote',
                    'text' => 'Scalability is mostly a byproduct of clarity. Systems that are easy to understand tend to be easy to grow.',
                ],
                10 => [
                    'type' => 'p',
                    'text' => 'None of this is glamorous, and thatâ€™s the point. The teams whose products scale smoothly are usually the ones who were slightly boring and disciplined at the very beginning.',
                ],
            ],
        ],
        1 => [
            'slug' => 'practical-ai-integration',
            'title' => 'Practical AI Integration: Beyond the Hype',
            'category' => 'AI & Automation',
            'excerpt' => 'Most AI features fail because they solve no real problem. A framework for shipping AI that users actually keep using.',
            'image' => '/storage/images/blog-featured-1-2.webp',
            'author' => 'Qasim Javed',
            'authorRole' => 'Senior Backend Developer',
            'date' => '2026-07-15',
            'readTime' => 9,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Adding â€œAIâ€ to a product is easy. Adding AI that people actually keep using is not. The difference is almost never the model â€” itâ€™s whether the feature is aimed at a real, repeated pain point.',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Start from the job, not the technology',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'Before we integrate anything, we ask: what task is the user doing today that is slow, repetitive or error-prone? If we canâ€™t name that task in one sentence, the feature isnâ€™t ready to build yet.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Ground the model in your own data',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'General models are impressive but generic. The value shows up when you connect them to your own documents, tickets or catalog through retrieval-augmented generation, so answers are specific and verifiable instead of plausible-sounding guesses.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'Design the failure cases',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'AI features fail differently from normal code â€” theyâ€™re confidently wrong. We plan for that: clear â€œIâ€™m not sureâ€ states, easy human handoff, and guardrails that keep the model inside the task it was given.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'A concrete, repeated task the feature accelerates',
                        1 => 'Retrieval grounded in the clientâ€™s real content',
                        2 => 'Visible confidence and graceful fallbacks',
                        3 => 'Cost and latency budgets set before launch',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'The best AI features feel less like magic and more like a very fast, slightly cautious assistant.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'Ship the smallest version that solves one real task well, measure whether people come back to it, and expand from there. That single loop separates useful AI from expensive novelty.',
                ],
            ],
        ],
        2 => [
            'slug' => 'mern-stack-2026',
            'title' => 'The MERN Stack in 2026: Still Worth Learning?',
            'category' => 'MERN Stack',
            'excerpt' => 'The JavaScript ecosystem moves fast. We break down where the MERN stack still shines and how to learn it the smart way.',
            'image' => '/storage/images/blog-featured-1-3.webp',
            'author' => 'Hafiz M. Nadeem',
            'authorRole' => 'MERN Stack Developer',
            'date' => '2026-06-30',
            'readTime' => 6,
            'featured' => false,
            'body' => [
                0 => [
                    'type' => 'p',
                    'text' => 'Every year someone declares the MERN stack dead, and every year thousands of products keep shipping on it. So where does MongoDB, Express, React and Node.js actually stand in 2026?',
                ],
                1 => [
                    'type' => 'h2',
                    'text' => 'Why it still holds up',
                ],
                2 => [
                    'type' => 'p',
                    'text' => 'One language across the whole stack lowers the barrier to full-stack work dramatically. For startups and small teams, being able to move between the API and the UI without switching mental models is a real, measurable advantage.',
                ],
                3 => [
                    'type' => 'h2',
                    'text' => 'Where it isnâ€™t the right tool',
                ],
                4 => [
                    'type' => 'p',
                    'text' => 'Heavily relational data, strict transactional guarantees, or teams that already live in another ecosystem are all good reasons to look elsewhere. MERN is a strong default, not a universal answer.',
                ],
                5 => [
                    'type' => 'h2',
                    'text' => 'How to learn it without drowning',
                ],
                6 => [
                    'type' => 'p',
                    'text' => 'Donâ€™t try to learn all four pieces at once. Get comfortable with JavaScript and React first, then add Node and Express, and only then introduce MongoDB. Build one real project end to end rather than following ten disconnected tutorials.',
                ],
                7 => [
                    'type' => 'ul',
                    'items' => [
                        0 => 'Solid JavaScript fundamentals before any framework',
                        1 => 'One full project from database to deployed UI',
                        2 => 'Authentication and deployment â€” the parts tutorials skip',
                        3 => 'Reading other peopleâ€™s code, not just writing your own',
                    ],
                ],
                8 => [
                    'type' => 'quote',
                    'text' => 'The stack you finish a real project with beats the â€œperfectâ€ stack you never ship.',
                ],
                9 => [
                    'type' => 'p',
                    'text' => 'For most people entering web development, MERN remains one of the fastest routes from zero to a working, deployable full-stack app â€” and thatâ€™s exactly why we still teach it.',
                ],
            ],
        ],
    ],
];
