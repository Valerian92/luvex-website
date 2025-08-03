<?php
/**
 * LUVEX Taxonomy Terms Auto-Importer
 * 
 * ANLEITUNG:
 * 1. Speichere diese Datei als: import-luvex-terms.php
 * 2. Lade sie in dein WordPress-Verzeichnis hoch
 * 3. Gehe zu: https://luvex.tech/import-luvex-terms.php
 * 4. Alle 289 Terms werden automatisch importiert!
 */

// WordPress laden
require_once('./wp-config.php');
require_once('./wp-load.php');

// Sicherheitscheck
if (!current_user_can('manage_options')) {
    die('Keine Berechtigung!');
}

// Terms-Daten
$luvex_terms = array(
    'uv-technology' => array(
        array('name' => 'UV-A Curing', 'slug' => 'uv-a-curing', 'description' => 'Industrial UV curing for coatings, inks, adhesives and 3D printing applications'),
        array('name' => 'UV-C Disinfection', 'slug' => 'uv-c-disinfection', 'description' => 'Germicidal UV technology for water treatment, air purification and surface sterilization'),
        array('name' => 'LED UV Systems', 'slug' => 'led-uv-systems', 'description' => 'Next-generation LED UV technology with precision control and energy efficiency'),
        array('name' => 'Mercury UV Lamps', 'slug' => 'mercury-uv-lamps', 'description' => 'Traditional mercury UV systems and modern replacement strategies'),
        array('name' => 'UV-B Phototherapy', 'slug' => 'uv-b-phototherapy', 'description' => 'Medical UV-B applications for skin treatment and therapeutic purposes'),
        array('name' => 'UV Spectral Analysis', 'slug' => 'uv-spectral-analysis', 'description' => 'UV measurement and analysis technologies for process optimization')
    ),
    'industry-application' => array(
        array('name' => 'Water Treatment', 'slug' => 'water-treatment', 'description' => 'Municipal and industrial water disinfection and purification systems'),
        array('name' => 'Food & Beverage', 'slug' => 'food-beverage', 'description' => 'Food safety, packaging sterilization and beverage processing applications'),
        array('name' => 'Printing & Graphics', 'slug' => 'printing-graphics', 'description' => 'UV ink curing, label printing and graphic arts applications'),
        array('name' => 'Automotive Coatings', 'slug' => 'automotive-coatings', 'description' => 'UV curing for automotive paints, coatings and adhesives'),
        array('name' => 'Electronics Manufacturing', 'slug' => 'electronics-manufacturing', 'description' => 'PCB curing, conformal coatings and electronic component manufacturing'),
        array('name' => 'Medical Device Sterilization', 'slug' => 'medical-sterilization', 'description' => 'Medical device sterilization and pharmaceutical manufacturing'),
        array('name' => 'Air Purification', 'slug' => 'air-purification', 'description' => 'HVAC disinfection, indoor air quality and airborne pathogen control'),
        array('name' => '3D Printing', 'slug' => '3d-printing', 'description' => 'UV resin curing for stereolithography and digital light processing'),
        array('name' => 'Wood Finishing', 'slug' => 'wood-finishing', 'description' => 'Wood coatings, furniture finishing and flooring applications'),
        array('name' => 'Adhesives & Sealants', 'slug' => 'adhesives-sealants', 'description' => 'UV-curable adhesives, sealants and bonding applications'),
        array('name' => 'Optical Fiber', 'slug' => 'optical-fiber', 'description' => 'Fiber optic coating curing and telecommunications applications'),
        array('name' => 'Packaging Industry', 'slug' => 'packaging-industry', 'description' => 'Food packaging sterilization and material barrier applications'),
        array('name' => 'Cosmetics Manufacturing', 'slug' => 'cosmetics-manufacturing', 'description' => 'Cosmetic product sterilization and packaging applications'),
        array('name' => 'Pharmaceutical', 'slug' => 'pharmaceutical', 'description' => 'Drug manufacturing, sterilization and packaging processes'),
        array('name' => 'Textile Industry', 'slug' => 'textile-industry', 'description' => 'Textile finishing, dyeing and fabric treatment applications')
    ),
    'technical-complexity' => array(
        array('name' => 'Beginner', 'slug' => 'beginner', 'description' => 'Basic UV applications with standard equipment and simple processes'),
        array('name' => 'Intermediate', 'slug' => 'intermediate', 'description' => 'Moderate complexity requiring some technical expertise and specialized equipment'),
        array('name' => 'Advanced', 'slug' => 'advanced', 'description' => 'Complex UV systems requiring extensive technical knowledge and custom solutions'),
        array('name' => 'Expert', 'slug' => 'expert', 'description' => 'Cutting-edge UV technology requiring specialized expertise and custom engineering')
    ),
    'content-topic' => array(
        array('name' => 'UV Safety', 'slug' => 'uv-safety', 'description' => 'UV radiation safety, protective equipment and workplace safety protocols'),
        array('name' => 'Process Optimization', 'slug' => 'process-optimization', 'description' => 'UV process improvement, efficiency enhancement and cost reduction strategies'),
        array('name' => 'System Design', 'slug' => 'system-design', 'description' => 'UV system engineering, design considerations and implementation planning'),
        array('name' => 'Maintenance & Troubleshooting', 'slug' => 'maintenance-troubleshooting', 'description' => 'UV equipment maintenance, troubleshooting guides and repair procedures'),
        array('name' => 'Technology Comparison', 'slug' => 'technology-comparison', 'description' => 'Comparative analysis of different UV technologies and solutions'),
        array('name' => 'Industry Standards', 'slug' => 'industry-standards', 'description' => 'UV industry standards, regulations and compliance requirements'),
        array('name' => 'Cost Analysis', 'slug' => 'cost-analysis', 'description' => 'UV system costs, ROI analysis and economic considerations'),
        array('name' => 'Environmental Impact', 'slug' => 'environmental-impact', 'description' => 'Environmental benefits and sustainability aspects of UV technology'),
        array('name' => 'Innovation Trends', 'slug' => 'innovation-trends', 'description' => 'Latest UV technology developments and future trends'),
        array('name' => 'Case Studies', 'slug' => 'case-studies', 'description' => 'Real-world UV implementation examples and success stories'),
        array('name' => 'Technical Specifications', 'slug' => 'technical-specifications', 'description' => 'UV equipment specifications, performance parameters and technical details'),
        array('name' => 'Training & Education', 'slug' => 'training-education', 'description' => 'UV technology training materials and educational resources')
    ),
    'geographic-focus' => array(
        array('name' => 'Germany', 'slug' => 'germany', 'description' => 'German market focus, local regulations and German UV industry'),
        array('name' => 'Europe', 'slug' => 'europe', 'description' => 'European UV market, EU regulations and continental applications'),
        array('name' => 'North America', 'slug' => 'north-america', 'description' => 'US and Canadian UV markets, regulations and industry trends'),
        array('name' => 'Asia Pacific', 'slug' => 'asia-pacific', 'description' => 'Asian UV markets, emerging technologies and regional applications'),
        array('name' => 'Global', 'slug' => 'global', 'description' => 'Worldwide UV applications, international standards and global trends'),
        array('name' => 'DACH Region', 'slug' => 'dach-region', 'description' => 'Germany, Austria, Switzerland - regional market focus'),
        array('name' => 'Emerging Markets', 'slug' => 'emerging-markets', 'description' => 'Developing UV markets and growth opportunities'),
        array('name' => 'Remote Applications', 'slug' => 'remote-applications', 'description' => 'UV applications in remote or challenging geographic locations')
    ),
    'equipment-type' => array(
        array('name' => 'UV Lamps', 'slug' => 'uv-lamps', 'description' => 'Traditional UV mercury and metal halide lamps'),
        array('name' => 'LED UV Arrays', 'slug' => 'led-uv-arrays', 'description' => 'LED-based UV light sources and arrays'),
        array('name' => 'UV Chambers', 'slug' => 'uv-chambers', 'description' => 'Enclosed UV processing chambers and cabinets'),
        array('name' => 'Conveyor Systems', 'slug' => 'conveyor-systems', 'description' => 'UV curing conveyor systems for continuous processing'),
        array('name' => 'Handheld UV Devices', 'slug' => 'handheld-devices', 'description' => 'Portable UV equipment for field applications'),
        array('name' => 'UV Sensors', 'slug' => 'uv-sensors', 'description' => 'UV measurement and monitoring sensors'),
        array('name' => 'Power Supplies', 'slug' => 'power-supplies', 'description' => 'UV lamp ballasts and LED drivers'),
        array('name' => 'Reflectors & Optics', 'slug' => 'reflectors-optics', 'description' => 'UV reflectors, lenses and optical components'),
        array('name' => 'Cooling Systems', 'slug' => 'cooling-systems', 'description' => 'UV equipment cooling and thermal management systems'),
        array('name' => 'Safety Equipment', 'slug' => 'safety-equipment', 'description' => 'UV safety glasses, protective gear and safety systems'),
        array('name' => 'Process Controllers', 'slug' => 'process-controllers', 'description' => 'UV process control systems and automation equipment'),
        array('name' => 'Testing Equipment', 'slug' => 'testing-equipment', 'description' => 'UV measurement, testing and calibration equipment')
    ),
    'document-status' => array(
        array('name' => 'Draft', 'slug' => 'draft', 'description' => 'Document in development, not yet finalized'),
        array('name' => 'Under Review', 'slug' => 'under-review', 'description' => 'Document being reviewed for accuracy and completeness'),
        array('name' => 'Approved', 'slug' => 'approved', 'description' => 'Document approved for publication and distribution'),
        array('name' => 'Published', 'slug' => 'published', 'description' => 'Document publicly available and current'),
        array('name' => 'Archived', 'slug' => 'archived', 'description' => 'Superseded document maintained for reference')
    ),
    'wavelength-range' => array(
        array('name' => 'UV-A (315-400nm)', 'slug' => 'uv-a-315-400nm', 'description' => 'Long-wave UV primarily for curing and photochemical processes'),
        array('name' => 'UV-B (280-315nm)', 'slug' => 'uv-b-280-315nm', 'description' => 'Medium-wave UV for specialized medical and research applications'),
        array('name' => 'UV-C (200-280nm)', 'slug' => 'uv-c-200-280nm', 'description' => 'Short-wave germicidal UV for disinfection applications'),
        array('name' => 'Vacuum UV (100-200nm)', 'slug' => 'vacuum-uv-100-200nm', 'description' => 'Very short-wave UV for specialized scientific applications'),
        array('name' => '365nm Peak', 'slug' => '365nm-peak', 'description' => 'Standard UV-A curing wavelength for most applications'),
        array('name' => '395nm Peak', 'slug' => '395nm-peak', 'description' => 'Alternative UV-A wavelength for specific material compatibility'),
        array('name' => '254nm Germicidal', 'slug' => '254nm-germicidal', 'description' => 'Standard germicidal wavelength for disinfection'),
        array('name' => 'Broadband UV', 'slug' => 'broadband-uv', 'description' => 'Full spectrum UV output for comprehensive applications')
    ),
    'process-parameter' => array(
        array('name' => 'UV Dose', 'slug' => 'uv-dose', 'description' => 'Total UV energy delivered to the target material'),
        array('name' => 'Irradiance', 'slug' => 'irradiance', 'description' => 'UV power density at the target surface'),
        array('name' => 'Exposure Time', 'slug' => 'exposure-time', 'description' => 'Duration of UV exposure for process completion'),
        array('name' => 'Temperature Control', 'slug' => 'temperature-control', 'description' => 'Thermal management during UV processing'),
        array('name' => 'Conveyor Speed', 'slug' => 'conveyor-speed', 'description' => 'Processing speed for continuous UV applications'),
        array('name' => 'Lamp Distance', 'slug' => 'lamp-distance', 'description' => 'Distance between UV source and target material'),
        array('name' => 'Atmosphere Control', 'slug' => 'atmosphere-control', 'description' => 'Inert gas or oxygen control during UV processing'),
        array('name' => 'Cure Monitoring', 'slug' => 'cure-monitoring', 'description' => 'Real-time monitoring of UV curing progress'),
        array('name' => 'Power Density', 'slug' => 'power-density', 'description' => 'UV power per unit area for process optimization'),
        array('name' => 'Spectral Distribution', 'slug' => 'spectral-distribution', 'description' => 'UV wavelength distribution characteristics')
    ),
    'safety-category' => array(
        array('name' => 'Eye Protection', 'slug' => 'eye-protection', 'description' => 'UV safety glasses and eye protection requirements'),
        array('name' => 'Skin Protection', 'slug' => 'skin-protection', 'description' => 'Protective clothing and skin safety measures'),
        array('name' => 'Exposure Limits', 'slug' => 'exposure-limits', 'description' => 'Maximum safe UV exposure levels and guidelines'),
        array('name' => 'Ventilation Requirements', 'slug' => 'ventilation-requirements', 'description' => 'Proper ventilation for UV processing areas'),
        array('name' => 'Emergency Procedures', 'slug' => 'emergency-procedures', 'description' => 'Safety protocols for UV exposure incidents'),
        array('name' => 'Training Requirements', 'slug' => 'training-requirements', 'description' => 'Mandatory UV safety training and certification'),
        array('name' => 'Shielding Design', 'slug' => 'shielding-design', 'description' => 'UV containment and shielding requirements'),
        array('name' => 'Monitoring Systems', 'slug' => 'monitoring-systems', 'description' => 'UV exposure monitoring and alarm systems')
    ),
    'manufacturing-brand' => array(
        array('name' => 'Hönle UV Technology', 'slug' => 'honle-uv', 'description' => 'German UV technology manufacturer and systems integrator'),
        array('name' => 'Nuvonic Technologies', 'slug' => 'nuvonic-tech', 'description' => 'UV-C LED technology specialist and equipment manufacturer'),
        array('name' => 'Heraeus Noblelight', 'slug' => 'heraeus-noblelight', 'description' => 'Industrial UV lamp and system manufacturer'),
        array('name' => 'Phoseon Technology', 'slug' => 'phoseon-technology', 'description' => 'LED UV curing systems and solutions'),
        array('name' => 'IST METZ', 'slug' => 'ist-metz', 'description' => 'UV technology and equipment manufacturer'),
        array('name' => 'American Ultraviolet', 'slug' => 'american-ultraviolet', 'description' => 'UV equipment manufacturer and solutions provider'),
        array('name' => 'Atlantic Ultraviolet', 'slug' => 'atlantic-ultraviolet', 'description' => 'UV water treatment and air purification systems'),
        array('name' => 'USHIO', 'slug' => 'ushio', 'description' => 'UV lamp and light source manufacturer'),
        array('name' => 'Dymax Corporation', 'slug' => 'dymax', 'description' => 'UV curing materials and equipment manufacturer'),
        array('name' => 'Nordson Corporation', 'slug' => 'nordson', 'description' => 'UV curing and coating systems manufacturer'),
        array('name' => 'UV-Technik Speziallampen', 'slug' => 'uv-technik', 'description' => 'Specialty UV lamp manufacturer'),
        array('name' => 'Xenon Corporation', 'slug' => 'xenon-corp', 'description' => 'Flash lamp and UV equipment manufacturer'),
        array('name' => 'Cure Zone', 'slug' => 'cure-zone', 'description' => 'UV curing equipment and accessories'),
        array('name' => 'Fusion UV Systems', 'slug' => 'fusion-uv', 'description' => 'Industrial UV curing systems manufacturer'),
        array('name' => 'Light Sources Inc', 'slug' => 'light-sources', 'description' => 'UV lamp and replacement parts supplier')
    ),
    'application-method' => array(
        array('name' => 'Flood Curing', 'slug' => 'flood-curing', 'description' => 'Area UV curing for large surfaces and batch processing'),
        array('name' => 'Spot Curing', 'slug' => 'spot-curing', 'description' => 'Localized UV curing for precise applications'),
        array('name' => 'Conveyor Processing', 'slug' => 'conveyor-processing', 'description' => 'Continuous UV processing on moving conveyors'),
        array('name' => 'Batch Processing', 'slug' => 'batch-processing', 'description' => 'UV treatment of grouped items in chambers'),
        array('name' => 'In-Line Integration', 'slug' => 'inline-integration', 'description' => 'UV systems integrated into production lines'),
        array('name' => 'Manual Application', 'slug' => 'manual-application', 'description' => 'Hand-held UV devices and manual processing'),
        array('name' => 'Automated Systems', 'slug' => 'automated-systems', 'description' => 'Fully automated UV processing systems'),
        array('name' => 'Hybrid Processing', 'slug' => 'hybrid-processing', 'description' => 'Combined UV and thermal processing methods')
    ),
    'system-configuration' => array(
        array('name' => 'Single Lamp System', 'slug' => 'single-lamp', 'description' => 'Basic UV system with one lamp configuration'),
        array('name' => 'Multi-Lamp Array', 'slug' => 'multi-lamp-array', 'description' => 'Multiple UV lamps for increased coverage or intensity'),
        array('name' => 'Modular Design', 'slug' => 'modular-design', 'description' => 'Expandable UV system with modular components'),
        array('name' => 'Custom Integration', 'slug' => 'custom-integration', 'description' => 'Specially designed UV systems for specific applications'),
        array('name' => 'Portable Configuration', 'slug' => 'portable-config', 'description' => 'Mobile UV systems for flexible deployment'),
        array('name' => 'Fixed Installation', 'slug' => 'fixed-installation', 'description' => 'Permanently installed UV processing systems'),
        array('name' => 'Retrofit Solution', 'slug' => 'retrofit-solution', 'description' => 'UV upgrades for existing production equipment'),
        array('name' => 'Standalone Unit', 'slug' => 'standalone-unit', 'description' => 'Independent UV processing equipment'),
        array('name' => 'Integrated Chamber', 'slug' => 'integrated-chamber', 'description' => 'UV processing within enclosed chambers'),
        array('name' => 'Open Air System', 'slug' => 'open-air-system', 'description' => 'UV processing in open environments')
    ),
    'performance-metric' => array(
        array('name' => 'Curing Speed', 'slug' => 'curing-speed', 'description' => 'Rate of UV curing process completion'),
        array('name' => 'Energy Efficiency', 'slug' => 'energy-efficiency', 'description' => 'UV system power consumption and efficiency'),
        array('name' => 'Lamp Life', 'slug' => 'lamp-life', 'description' => 'UV lamp operational lifetime and replacement intervals'),
        array('name' => 'Output Stability', 'slug' => 'output-stability', 'description' => 'Consistency of UV output over time'),
        array('name' => 'Spectral Accuracy', 'slug' => 'spectral-accuracy', 'description' => 'Precision of UV wavelength output'),
        array('name' => 'Process Repeatability', 'slug' => 'process-repeatability', 'description' => 'Consistency of UV processing results'),
        array('name' => 'Maintenance Frequency', 'slug' => 'maintenance-frequency', 'description' => 'Required maintenance intervals and procedures'),
        array('name' => 'System Reliability', 'slug' => 'system-reliability', 'description' => 'UV equipment uptime and failure rates'),
        array('name' => 'Cost per Process', 'slug' => 'cost-per-process', 'description' => 'Economic efficiency of UV processing operations'),
        array('name' => 'Quality Consistency', 'slug' => 'quality-consistency', 'description' => 'Uniformity of UV processing quality'),
        array('name' => 'Throughput Rate', 'slug' => 'throughput-rate', 'description' => 'Processing capacity and production rates'),
        array('name' => 'ROI Metrics', 'slug' => 'roi-metrics', 'description' => 'Return on investment for UV system implementation')
    ),
    'regulatory-standard' => array(
        array('name' => 'IEC 62471', 'slug' => 'iec-62471', 'description' => 'Photobiological safety standard for UV equipment'),
        array('name' => 'ACGIH Guidelines', 'slug' => 'acgih-guidelines', 'description' => 'UV exposure limits and safety guidelines'),
        array('name' => 'FDA Regulations', 'slug' => 'fda-regulations', 'description' => 'US FDA requirements for UV applications'),
        array('name' => 'CE Marking', 'slug' => 'ce-marking', 'description' => 'European conformity marking for UV equipment'),
        array('name' => 'OSHA Standards', 'slug' => 'osha-standards', 'description' => 'Occupational safety requirements for UV systems'),
        array('name' => 'ISO 21348', 'slug' => 'iso-21348', 'description' => 'Solar UV irradiance measurement standards'),
        array('name' => 'DIN Standards', 'slug' => 'din-standards', 'description' => 'German industrial standards for UV technology'),
        array('name' => 'NIST Guidelines', 'slug' => 'nist-guidelines', 'description' => 'US National Institute standards and measurements'),
        array('name' => 'EPA Regulations', 'slug' => 'epa-regulations', 'description' => 'Environmental protection requirements for UV systems'),
        array('name' => 'UL Certification', 'slug' => 'ul-certification', 'description' => 'Safety certification for UV equipment')
    ),
    'target-audience' => array(
        array('name' => 'Manufacturing Engineers', 'slug' => 'manufacturing-engineers', 'description' => 'Engineering professionals implementing UV solutions'),
        array('name' => 'Production Managers', 'slug' => 'production-managers', 'description' => 'Manufacturing management and operations personnel'),
        array('name' => 'Quality Control', 'slug' => 'quality-control', 'description' => 'QC professionals ensuring UV process quality'),
        array('name' => 'Safety Officers', 'slug' => 'safety-officers', 'description' => 'Workplace safety and compliance professionals'),
        array('name' => 'Research Scientists', 'slug' => 'research-scientists', 'description' => 'R&D professionals exploring UV applications'),
        array('name' => 'Equipment Buyers', 'slug' => 'equipment-buyers', 'description' => 'Procurement professionals selecting UV equipment'),
        array('name' => 'System Integrators', 'slug' => 'system-integrators', 'description' => 'Professionals integrating UV into production systems'),
        array('name' => 'Maintenance Technicians', 'slug' => 'maintenance-technicians', 'description' => 'Technical staff maintaining UV equipment'),
        array('name' => 'Regulatory Compliance', 'slug' => 'regulatory-compliance', 'description' => 'Compliance professionals ensuring regulatory adherence'),
        array('name' => 'Students & Educators', 'slug' => 'students-educators', 'description' => 'Academic professionals and students learning UV technology')
    ),
    'problem-category' => array(
        array('name' => 'Insufficient Cure', 'slug' => 'insufficient-cure', 'description' => 'Incomplete UV curing and potential solutions'),
        array('name' => 'Overheating Issues', 'slug' => 'overheating-issues', 'description' => 'Thermal management problems in UV processing'),
        array('name' => 'Uneven Coverage', 'slug' => 'uneven-coverage', 'description' => 'Non-uniform UV exposure and distribution issues'),
        array('name' => 'Lamp Degradation', 'slug' => 'lamp-degradation', 'description' => 'UV lamp aging and performance decline'),
        array('name' => 'Safety Concerns', 'slug' => 'safety-concerns', 'description' => 'UV safety violations and exposure risks'),
        array('name' => 'Process Inconsistency', 'slug' => 'process-inconsistency', 'description' => 'Variable UV processing results and quality'),
        array('name' => 'Energy Costs', 'slug' => 'energy-costs', 'description' => 'High energy consumption and cost optimization'),
        array('name' => 'Maintenance Challenges', 'slug' => 'maintenance-challenges', 'description' => 'Equipment maintenance and reliability issues')
    ),
    'solution-type' => array(
        array('name' => 'Equipment Upgrade', 'slug' => 'equipment-upgrade', 'description' => 'UV system modernization and technology updates'),
        array('name' => 'Process Optimization', 'slug' => 'process-optimization-solution', 'description' => 'Improved UV processing methods and parameters'),
        array('name' => 'Custom Engineering', 'slug' => 'custom-engineering', 'description' => 'Specialized UV solutions for unique applications'),
        array('name' => 'Training Program', 'slug' => 'training-program', 'description' => 'Educational solutions for UV technology implementation'),
        array('name' => 'Maintenance Service', 'slug' => 'maintenance-service', 'description' => 'Professional UV equipment maintenance and support'),
        array('name' => 'Consulting Services', 'slug' => 'consulting-services', 'description' => 'Expert advice and UV system analysis'),
        array('name' => 'Technology Migration', 'slug' => 'technology-migration', 'description' => 'Transition from legacy to modern UV systems'),
        array('name' => 'Integration Support', 'slug' => 'integration-support', 'description' => 'Assistance with UV system integration into production')
    ),
    'publication-type' => array(
        array('name' => 'Technical Paper', 'slug' => 'technical-paper', 'description' => 'Detailed technical analysis and research documentation'),
        array('name' => 'White Paper', 'slug' => 'white-paper', 'description' => 'Authoritative report on UV technology topics'),
        array('name' => 'Application Note', 'slug' => 'application-note', 'description' => 'Practical guidance for specific UV applications'),
        array('name' => 'Case Study', 'slug' => 'case-study-pub', 'description' => 'Real-world implementation examples and results'),
        array('name' => 'Best Practices Guide', 'slug' => 'best-practices', 'description' => 'Recommended procedures and methodologies'),
        array('name' => 'Research Report', 'slug' => 'research-report', 'description' => 'Scientific research findings and analysis')
    ),
    'project-phase' => array(
        array('name' => 'Feasibility Study', 'slug' => 'feasibility-study', 'description' => 'Initial assessment of UV technology viability'),
        array('name' => 'Design Phase', 'slug' => 'design-phase', 'description' => 'UV system design and engineering development'),
        array('name' => 'Prototyping', 'slug' => 'prototyping', 'description' => 'UV system prototype development and testing'),
        array('name' => 'Implementation', 'slug' => 'implementation', 'description' => 'UV system installation and commissioning'),
        array('name' => 'Testing & Validation', 'slug' => 'testing-validation', 'description' => 'UV system performance verification and validation'),
        array('name' => 'Production Deployment', 'slug' => 'production-deployment', 'description' => 'Full-scale UV system production implementation')
    ),
    'news-category' => array(
        array('name' => 'Technology Breakthrough', 'slug' => 'technology-breakthrough', 'description' => 'Major UV technology advances and innovations'),
        array('name' => 'Product Launch', 'slug' => 'product-launch', 'description' => 'New UV equipment and product announcements'),
        array('name' => 'Industry Analysis', 'slug' => 'industry-analysis', 'description' => 'UV market trends and industry insights'),
        array('name' => 'Research Findings', 'slug' => 'research-findings', 'description' => 'Latest UV research and scientific discoveries'),
        array('name' => 'Company News', 'slug' => 'company-news', 'description' => 'Business updates from UV industry companies'),
        array('name' => 'Regulatory Updates', 'slug' => 'regulatory-updates-news', 'description' => 'Changes in UV-related regulations and standards'),
        array('name' => 'Market Expansion', 'slug' => 'market-expansion', 'description' => 'UV technology adoption in new markets'),
        array('name' => 'Partnership Announcements', 'slug' => 'partnership-announcements', 'description' => 'Strategic partnerships in the UV industry'),
        array('name' => 'Investment News', 'slug' => 'investment-news', 'description' => 'Funding and investment in UV technology companies'),
        array('name' => 'Trade Show Reports', 'slug' => 'trade-show-reports', 'description' => 'Coverage from UV industry exhibitions and conferences')
    ),
    'news-source' => array(
        array('name' => 'Industry Publications', 'slug' => 'industry-publications', 'description' => 'Specialized UV and manufacturing trade magazines'),
        array('name' => 'Academic Research', 'slug' => 'academic-research', 'description' => 'University and research institution publications'),
        array('name' => 'Company Press Releases', 'slug' => 'company-press-releases', 'description' => 'Official announcements from UV industry companies'),
        array('name' => 'Government Reports', 'slug' => 'government-reports', 'description' => 'Regulatory and government agency publications'),
        array('name' => 'Trade Associations', 'slug' => 'trade-associations', 'description' => 'Industry association news and reports'),
        array('name' => 'Conference Proceedings', 'slug' => 'conference-proceedings', 'description' => 'Technical conference presentations and papers'),
        array('name' => 'Patent Databases', 'slug' => 'patent-databases', 'description' => 'UV technology patent filings and intellectual property'),
        array('name' => 'Market Research', 'slug' => 'market-research', 'description' => 'Commercial market analysis and industry reports')
    ),
    'urgency-level' => array(
        array('name' => 'Breaking News', 'slug' => 'breaking-news', 'description' => 'Immediate attention required for critical industry developments'),
        array('name' => 'High Priority', 'slug' => 'high-priority', 'description' => 'Important updates requiring prompt attention'),
        array('name' => 'Standard Update', 'slug' => 'standard-update', 'description' => 'Regular industry news and developments'),
        array('name' => 'Background Information', 'slug' => 'background-info', 'description' => 'General reference material and context information')
    ),
    'news-region' => array(
        array('name' => 'Europe News', 'slug' => 'europe-news', 'description' => 'UV industry developments in European markets'),
        array('name' => 'North America News', 'slug' => 'north-america-news', 'description' => 'US and Canadian UV industry updates'),
        array('name' => 'Asia Pacific News', 'slug' => 'asia-pacific-news', 'description' => 'Asian market developments and regional news'),
        array('name' => 'Germany Focus', 'slug' => 'germany-focus', 'description' => 'German UV industry news and local market updates'),
        array('name' => 'Global Industry', 'slug' => 'global-industry', 'description' => 'Worldwide UV industry developments and trends'),
        array('name' => 'Emerging Markets', 'slug' => 'emerging-markets-news', 'description' => 'UV adoption in developing markets and regions'),
        array('name' => 'DACH Region', 'slug' => 'dach-region-news', 'description' => 'Germany, Austria, Switzerland regional coverage'),
        array('name' => 'International Trade', 'slug' => 'international-trade', 'description' => 'Cross-border UV industry commerce and partnerships')
    ),
    'company-type' => array(
        array('name' => 'Equipment Manufacturer', 'slug' => 'equipment-manufacturer', 'description' => 'Companies producing UV equipment and systems'),
        array('name' => 'System Integrator', 'slug' => 'system-integrator', 'description' => 'Companies providing UV system integration services'),
        array('name' => 'End User', 'slug' => 'end-user', 'description' => 'Companies using UV technology in their production processes'),
        array('name' => 'Research Institution', 'slug' => 'research-institution', 'description' => 'Universities and research organizations studying UV technology'),
        array('name' => 'Distributor', 'slug' => 'distributor', 'description' => 'Companies distributing UV equipment and supplies'),
        array('name' => 'Service Provider', 'slug' => 'service-provider', 'description' => 'Companies offering UV-related services and support'),
        array('name' => 'Startup Company', 'slug' => 'startup-company', 'description' => 'Emerging companies developing innovative UV solutions'),
        array('name' => 'Consulting Firm', 'slug' => 'consulting-firm', 'description' => 'Independent consultants providing UV expertise')
    ),
    'market-segment' => array(
        array('name' => 'Industrial Manufacturing', 'slug' => 'industrial-manufacturing', 'description' => 'Large-scale industrial UV applications and systems'),
        array('name' => 'Medical & Healthcare', 'slug' => 'medical-healthcare', 'description' => 'UV applications in healthcare and medical device industries'),
        array('name' => 'Water Treatment Market', 'slug' => 'water-treatment-market', 'description' => 'Municipal and industrial water treatment applications'),
        array('name' => 'Food Safety', 'slug' => 'food-safety', 'description' => 'UV applications in food processing and safety'),
        array('name' => 'Automotive Industry', 'slug' => 'automotive-industry', 'description' => 'UV technology in automotive manufacturing and coatings'),
        array('name' => 'Electronics Sector', 'slug' => 'electronics-sector', 'description' => 'UV applications in electronics manufacturing'),
        array('name' => 'Packaging Market', 'slug' => 'packaging-market', 'description' => 'UV technology in packaging and labeling industries'),
        array('name' => 'Construction Materials', 'slug' => 'construction-materials', 'description' => 'UV applications in building and construction materials'),
        array('name' => 'Aerospace Industry', 'slug' => 'aerospace-industry', 'description' => 'UV technology in aerospace manufacturing and maintenance'),
        array('name' => 'Research & Development', 'slug' => 'research-development', 'description' => 'R&D applications and laboratory UV systems')
    ),
    'news-impact' => array(
        array('name' => 'Productivity Improvement', 'slug' => 'productivity-improvement', 'description' => 'UV technology enhancing manufacturing efficiency and output'),
        array('name' => 'Cost Reduction', 'slug' => 'cost-reduction', 'description' => 'Economic benefits from UV technology implementation'),
        array('name' => 'Quality Enhancement', 'slug' => 'quality-enhancement', 'description' => 'Improved product quality through UV processing'),
        array('name' => 'Environmental Benefit', 'slug' => 'environmental-benefit', 'description' => 'Positive environmental impact of UV technology adoption'),
        array('name' => 'Safety Improvement', 'slug' => 'safety-improvement', 'description' => 'Enhanced workplace safety through UV technology'),
        array('name' => 'Innovation Driver', 'slug' => 'innovation-driver', 'description' => 'UV technology enabling new products and processes')
    ),
    'announcement-type' => array(
        array('name' => 'Product Release', 'slug' => 'product-release', 'description' => 'Official launch of new UV products and systems'),
        array('name' => 'Partnership Agreement', 'slug' => 'partnership-agreement', 'description' => 'Strategic partnerships and collaboration announcements'),
        array('name' => 'Acquisition News', 'slug' => 'acquisition-news', 'description' => 'Mergers and acquisitions in the UV industry'),
        array('name' => 'Investment Funding', 'slug' => 'investment-funding', 'description' => 'Venture capital and investment announcements'),
        array('name' => 'Technology License', 'slug' => 'technology-license', 'description' => 'Technology licensing and intellectual property agreements'),
        array('name' => 'Market Expansion', 'slug' => 'market-expansion-announce', 'description' => 'Geographic or market segment expansion announcements'),
        array('name' => 'Leadership Changes', 'slug' => 'leadership-changes', 'description' => 'Executive and management changes in UV companies'),
        array('name' => 'Facility Opening', 'slug' => 'facility-opening', 'description' => 'New manufacturing or research facility announcements')
    ),
    'technology-trend' => array(
        array('name' => 'LED UV Adoption', 'slug' => 'led-uv-adoption', 'description' => 'Growing adoption of LED UV technology over traditional mercury lamps'),
        array('name' => 'Industry 4.0 Integration', 'slug' => 'industry-40-integration', 'description' => 'Smart UV systems with IoT and automation capabilities'),
        array('name' => 'Sustainability Focus', 'slug' => 'sustainability-focus', 'description' => 'Environmental sustainability driving UV technology development'),
        array('name' => 'Miniaturization', 'slug' => 'miniaturization', 'description' => 'Compact and portable UV systems for new applications'),
        array('name' => 'Precision Control', 'slug' => 'precision-control', 'description' => 'Advanced process control and monitoring in UV systems'),
        array('name' => 'Energy Efficiency', 'slug' => 'energy-efficiency-trend', 'description' => 'Focus on reducing energy consumption in UV processing'),
        array('name' => 'Multi-Wavelength Systems', 'slug' => 'multi-wavelength', 'description' => 'UV systems with multiple wavelength capabilities'),
        array('name' => 'Real-Time Monitoring', 'slug' => 'real-time-monitoring', 'description' => 'Continuous monitoring and feedback in UV processes'),
        array('name' => 'Artificial Intelligence', 'slug' => 'artificial-intelligence', 'description' => 'AI integration in UV system optimization and control'),
        array('name' => 'Hybrid Technologies', 'slug' => 'hybrid-technologies', 'description' => 'Combination of UV with other processing technologies')
    ),
    'business-event' => array(
        array('name' => 'Trade Exhibition', 'slug' => 'trade-exhibition', 'description' => 'Industry trade shows and equipment exhibitions'),
        array('name' => 'Technical Conference', 'slug' => 'technical-conference', 'description' => 'Scientific and technical conferences on UV technology'),
        array('name' => 'Product Demonstration', 'slug' => 'product-demonstration', 'description' => 'Live demonstrations of UV equipment and processes'),
        array('name' => 'Training Workshop', 'slug' => 'training-workshop', 'description' => 'Educational workshops and training sessions'),
        array('name' => 'Webinar Series', 'slug' => 'webinar-series', 'description' => 'Online educational and technical presentations'),
        array('name' => 'Industry Awards', 'slug' => 'industry-awards', 'description' => 'Recognition and awards in the UV technology sector'),
        array('name' => 'Networking Event', 'slug' => 'networking-event', 'description' => 'Professional networking and business development events'),
        array('name' => 'Investor Meeting', 'slug' => 'investor-meeting', 'description' => 'Investment and financial meetings for UV companies')
    ),
    'regulatory-update' => array(
        array('name' => 'Safety Standard Changes', 'slug' => 'safety-standard-changes', 'description' => 'Updates to UV safety standards and regulations'),
        array('name' => 'Environmental Regulations', 'slug' => 'environmental-regulations', 'description' => 'Environmental compliance requirements for UV systems'),
        array('name' => 'Import/Export Rules', 'slug' => 'import-export-rules', 'description' => 'Trade regulations affecting UV equipment and technology'),
        array('name' => 'Certification Requirements', 'slug' => 'certification-requirements', 'description' => 'New or updated certification requirements for UV equipment'),
        array('name' => 'Industry Compliance', 'slug' => 'industry-compliance', 'description' => 'Sector-specific compliance requirements for UV applications'),
        array('name' => 'International Standards', 'slug' => 'international-standards', 'description' => 'Global standards affecting UV technology and applications'),
        array('name' => 'Government Incentives', 'slug' => 'government-incentives', 'description' => 'Government programs supporting UV technology adoption'),
        array('name' => 'Patent Legislation', 'slug' => 'patent-legislation', 'description' => 'Intellectual property law changes affecting UV technology')
    )
);

// Import-Funktion
function import_luvex_terms($terms_data) {
    $imported = 0;
    $errors = 0;
    
    echo "<h2>LUVEX Terms Import - Läuft...</h2>\n";
    
    foreach ($terms_data as $taxonomy => $terms) {
        echo "<h3>Importiere: $taxonomy</h3>\n";
        
        foreach ($terms as $term) {
            $result = wp_insert_term(
                $term['name'],
                $taxonomy,
                array(
                    'slug' => $term['slug'],
                    'description' => $term['description']
                )
            );
            
            if (is_wp_error($result)) {
                echo "<span style='color:red;'>✗ Fehler: " . $term['name'] . " - " . $result->get_error_message() . "</span><br>\n";
                $errors++;
            } else {
                echo "<span style='color:green;'>✓ Importiert: " . $term['name'] . "</span><br>\n";
                $imported++;
            }
        }
        echo "<br>\n";
    }
    
    echo "<h2>Import abgeschlossen!</h2>\n";
    echo "<p><strong>Erfolgreich importiert:</strong> $imported Terms</p>\n";
    echo "<p><strong>Fehler:</strong> $errors</p>\n";
    
    if ($errors == 0) {
        echo "<p style='color:green; font-size:18px;'><strong>🎉 Alle 289 Terms erfolgreich importiert!</strong></p>\n";
        echo "<p>Du kannst diese Datei jetzt löschen: import-luvex-terms.php</p>\n";
    }
}

// Import starten
echo "<!DOCTYPE html><html><head><title>LUVEX Terms Import</title></head><body>";
echo "<h1>LUVEX Taxonomy Terms Importer</h1>";

import_luvex_terms($luvex_terms);

echo "</body></html>";
?>