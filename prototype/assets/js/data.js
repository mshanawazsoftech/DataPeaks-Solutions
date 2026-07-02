/* DataPeaks Solutions — content data (prototype)
   Single source for courses + weekly log. In WordPress this becomes CPTs. */

window.DP = window.DP || {};

DP.courses = [
  {
    code: "CDA", slug: "cda", name: "Certified Data Analyst", color: "cyan",
    tagline: "Turn raw data into decisions.",
    summary: "Excel, SQL, Power BI and statistics — the core toolkit for turning raw data into decisions.",
    tools: ["Python", "pandas", "numpy", "SQL", "Excel", "Power BI"],
    outcomes: ["Analyze real datasets with pandas", "Write production SQL", "Build Power BI dashboards", "Present insights to stakeholders"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Python foundations & pandas", desc: "Load, clean and explore a real CSV with pandas + numpy.", tools: ["pandas","numpy"] },
        { wk: "W2", title: "Data cleaning pipeline", desc: "Handle missing values, types, duplicates on a messy dataset.", tools: ["pandas"] },
        { wk: "W3", title: "SQL fundamentals", desc: "SELECT, JOIN, GROUP BY on an open sales database.", tools: ["SQL","SQLite"] },
        { wk: "W4", title: "Excel to dashboard", desc: "PivotTables and a first Power BI report.", tools: ["Excel","Power BI"] }
      ],
      "Intermediate": [
        { wk: "W1", title: "Window functions & CTEs", desc: "Advanced SQL analytics on transactional data.", tools: ["SQL"] },
        { wk: "W2", title: "EDA at scale", desc: "Statistical EDA and correlation analysis.", tools: ["pandas","seaborn"] }
      ],
      "Advanced": [
        { wk: "W1", title: "Analytics engineering", desc: "Model a semantic layer and KPI framework.", tools: ["dbt","SQL"] }
      ]
    }
  },
  {
    code: "CDS", slug: "cds", name: "Certified Data Scientist", color: "emerald",
    tagline: "From hypotheses to models that generalize.",
    summary: "Python, machine learning and predictive modeling for solving real business problems with data.",
    tools: ["Python", "scikit-learn", "Statistics", "Jupyter", "Matplotlib"],
    outcomes: ["Design experiments & A/B tests", "Train and evaluate ML models", "Avoid leakage & overfitting", "Communicate uncertainty"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Stats for data science", desc: "Distributions, sampling and hypothesis testing in Python.", tools: ["scipy","numpy"] },
        { wk: "W2", title: "Your first ML model", desc: "Train/test split, linear & logistic regression.", tools: ["scikit-learn"] },
        { wk: "W3", title: "Model evaluation", desc: "Cross-validation, metrics, confusion matrix.", tools: ["scikit-learn"] }
      ],
      "Intermediate": [ { wk: "W1", title: "Feature engineering", desc: "Encoding, scaling and pipelines.", tools: ["scikit-learn"] } ],
      "Advanced": [ { wk: "W1", title: "Ensembles & tuning", desc: "Gradient boosting and hyperparameter search.", tools: ["XGBoost"] } ]
    }
  },
  {
    code: "MLE", slug: "mle", name: "ML Engineering", color: "mle",
    tagline: "Ship models to production, reliably.",
    summary: "Build, train and deploy ML models at scale — from notebooks to production pipelines.",
    tools: ["Python", "FastAPI", "Docker", "MLflow", "CI/CD"],
    outcomes: ["Serve models via API", "Containerize with Docker", "Track experiments with MLflow", "Automate CI/CD for ML"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Model as an API", desc: "Wrap a trained model in FastAPI and test it.", tools: ["FastAPI"] },
        { wk: "W2", title: "Containerize it", desc: "Dockerize the service and run locally.", tools: ["Docker"] }
      ],
      "Intermediate": [ { wk: "W1", title: "Experiment tracking", desc: "Log runs and register models with MLflow.", tools: ["MLflow"] } ],
      "Advanced": [ { wk: "W1", title: "CI/CD for ML", desc: "Automated training + deploy pipeline.", tools: ["GitHub Actions"] } ]
    }
  },
  {
    code: "DE", slug: "de", name: "Data Engineering", color: "de",
    tagline: "Build the pipelines everything else runs on.",
    summary: "Design data pipelines, warehouses and ETL workflows that power every analytics team.",
    tools: ["Python", "SQL", "Airflow", "Spark", "Kafka", "dbt"],
    outcomes: ["Build ETL/ELT pipelines", "Orchestrate with Airflow", "Model a warehouse", "Process streams with Kafka"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Your first ETL", desc: "Extract from an API, transform, load to a database.", tools: ["Python","SQL"] },
        { wk: "W2", title: "Orchestrate with Airflow", desc: "Schedule the pipeline as a DAG.", tools: ["Airflow"] }
      ],
      "Intermediate": [ { wk: "W1", title: "Warehouse modeling", desc: "Star schema and dbt transformations.", tools: ["dbt"] } ],
      "Advanced": [ { wk: "W1", title: "Streaming pipeline", desc: "Real-time ingestion with Kafka + Spark.", tools: ["Kafka","Spark"] } ]
    }
  },
  {
    code: "GAI", slug: "genai", name: "Generative AI", color: "violet",
    tagline: "Build with LLMs like an engineer.",
    summary: "LLMs, prompt engineering and RAG systems — build the AI products defining this decade.",
    tools: ["Python", "LLMs", "RAG", "Embeddings", "Vector DB"],
    outcomes: ["Build a RAG application", "Design robust prompts", "Use embeddings & vector search", "Evaluate LLM outputs"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Prompting & the API", desc: "Call an LLM, structure prompts, handle outputs.", tools: ["LLM API"] },
        { wk: "W2", title: "Embeddings & search", desc: "Semantic search over documents.", tools: ["Embeddings","FAISS"] }
      ],
      "Intermediate": [ { wk: "W1", title: "Build a RAG app", desc: "Retrieve-augment-generate over your own docs.", tools: ["RAG","Vector DB"] } ],
      "Advanced": [ { wk: "W1", title: "Fine-tuning & eval", desc: "Adapt a model and measure quality.", tools: ["Fine-tuning"] } ]
    }
  },
  {
    code: "AAI", slug: "agentic", name: "Agentic AI", color: "pink",
    tagline: "Autonomous systems that use tools.",
    summary: "Design multi-step AI agents that plan, use tools and act on their own toward a goal.",
    tools: ["Python", "Agents", "Tool-use", "Orchestration", "Eval"],
    outcomes: ["Build a tool-using agent", "Orchestrate multi-step tasks", "Add memory & planning", "Evaluate agent reliability"],
    levels: {
      "Beginner": [
        { wk: "W1", title: "Your first agent", desc: "An agent that calls tools to answer a task.", tools: ["Agents"] },
        { wk: "W2", title: "Tools & memory", desc: "Give the agent tools and short-term memory.", tools: ["Tool-use"] }
      ],
      "Intermediate": [ { wk: "W1", title: "Multi-agent flows", desc: "Coordinate specialized agents.", tools: ["Orchestration"] } ],
      "Advanced": [ { wk: "W1", title: "Agent evaluation", desc: "Build an eval harness for reliability.", tools: ["Eval"] } ]
    }
  }
];

DP.weeklyLog = [
  { week: 1,  date: "Jul 7, 2026",  course: "CDA", level: "L1", project: "Explore a real dataset with pandas", tools: ["pandas","numpy"] },
  { week: 2,  date: "Jul 14, 2026", course: "CDS", level: "L1", project: "Stats foundations & first hypothesis test", tools: ["scipy","numpy"] },
  { week: 3,  date: "Jul 21, 2026", course: "DE",  level: "L1", project: "Your first ETL: API → database", tools: ["Python","SQL"] },
  { week: 4,  date: "Jul 28, 2026", course: "MLE", level: "L1", project: "Serve a trained model as an API", tools: ["FastAPI"] },
  { week: 5,  date: "Aug 4, 2026",  course: "GAI", level: "L1", project: "Prompting & the LLM API", tools: ["LLM API"] },
  { week: 6,  date: "Aug 11, 2026", course: "AAI", level: "L1", project: "Build your first tool-using agent", tools: ["Agents"] },
  { week: 7,  date: "Aug 18, 2026", course: "CDA", level: "L1", project: "Data cleaning pipeline on messy data", tools: ["pandas"] },
  { week: 8,  date: "Aug 25, 2026", course: "CDS", level: "L1", project: "Train & evaluate your first ML model", tools: ["scikit-learn"] },
  { week: 9,  date: "Sep 1, 2026",  course: "DE",  level: "L1", project: "Orchestrate the pipeline with Airflow", tools: ["Airflow"] },
  { week: 10, date: "Sep 8, 2026",  course: "MLE", level: "L1", project: "Containerize the service with Docker", tools: ["Docker"] },
  { week: 11, date: "Sep 15, 2026", course: "GAI", level: "L1", project: "Semantic search with embeddings", tools: ["Embeddings","FAISS"] },
  { week: 12, date: "Sep 22, 2026", course: "AAI", level: "L1", project: "Give your agent tools & memory", tools: ["Tool-use"] }
];

DP.social = [
  { name: "YouTube",   url: "https://youtube.com/@datapeakssolutions",
    svg: '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M23 12s0-3.9-.5-5.6a2.9 2.9 0 0 0-2-2C18.7 4 12 4 12 4s-6.7 0-8.5.4a2.9 2.9 0 0 0-2 2C1 8.1 1 12 1 12s0 3.9.5 5.6a2.9 2.9 0 0 0 2 2C5.3 20 12 20 12 20s6.7 0 8.5-.4a2.9 2.9 0 0 0 2-2C23 15.9 23 12 23 12Zm-13 3.5v-7l6 3.5-6 3.5Z"/></svg>' },
  { name: "Instagram", url: "https://instagram.com/datapeaks_solutions",
    svg: '<svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>' },
  { name: "Facebook",  url: "https://facebook.com/DatapeaksSolutions",
    svg: '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M22 12a10 10 0 1 0-11.6 9.9v-7H7.9V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.5h-1.2c-1.2 0-1.6.8-1.6 1.6V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12Z"/></svg>' },
  { name: "WhatsApp",  url: "https://whatsapp.com/channel/0029Vb8WGoL0gcfBsEi1in3z",
    svg: '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M12 2a10 10 0 0 0-8.5 15.3L2 22l4.8-1.5A10 10 0 1 0 12 2Zm5.5 14c-.2.6-1.2 1.2-1.7 1.2-.4 0-1 .1-3.2-.9-2.7-1.2-4.4-4-4.5-4.2-.1-.2-1.1-1.5-1.1-2.8s.7-2 .9-2.2c.2-.3.5-.3.7-.3h.5c.2 0 .4 0 .6.5l.8 1.9c.1.2.1.4 0 .6l-.4.5c-.2.2-.3.4-.1.7.2.3.9 1.4 1.9 2.3 1.3 1.1 2 1.3 2.3 1.1.2-.1.4-.4.6-.7.2-.3.4-.2.6-.1l1.8.9c.3.1.5.2.5.4.1.2.1.9-.1 1.6Z"/></svg>' }
];

DP.faqs = [
  { q: "Is Level 1 really free?", a: "Yes. Level 1 of every one of our six courses is fully free — all concepts, all tools, no paywall. Levels 2 & 3 go deeper and are part of our paid DataPeaks programs." },
  { q: "What makes DataPeaks different?", a: "Everything is project-based. One runnable project per week, built on open datasets, covering every tool in the stack — so you finish with a portfolio, not just notes." },
  { q: "Do I need prior experience?", a: "No. Every track starts at a true beginner level and builds toward placement-level mastery. Start at Level 1 of any course." },
  { q: "Which datasets do you use?", a: "Public project code uses only open-source / publicly available datasets. Proprietary student datasets and paid-course materials are never published." },
  { q: "Do you help with placements?", a: "Yes — our programs are placement-focused, building toward FAANG-ready skills, with training aligned to opportunities across India, UAE, UK, Australia, USA and Singapore." },
  { q: "How do I follow the weekly drops?", a: "Subscribe on YouTube and follow us on Instagram and our WhatsApp channel. Each week we drop a new project you can run yourself." }
];
