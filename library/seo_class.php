<?php
class seo{

 /*
     IWCN TEAM
    */

//public 	$api_key="AIzaSyDb2BNLmMxBE8Uwo__oZt-K91qWmNNox3E";
//public	$searchengine_id="016458265654446343705:33h20ap2x4e";

	/*Related to seoproject*/
//public  $api_key='AIzaSyA1-LKau7ZbbQ2ZROIpb-4llDXEScgmFhc';
//public $searchengine_id='016458265654446343705:hprsgr03a_s';


	/*Related to hajas project*/
public $api_key='AIzaSyCYBTtgkyzz9ftPlz0R9bsdha48Qp4z1F4';
public $searchengine_id= '016458265654446343705:3txrtogymkg';





public function gettld($domain)
{
    //function to find top level domain from given domain

    $tld = array(
        'AAA',
        'AARP',
        'ABB',
        'ABBOTT',
        'ABBVIE',
        'ABOGADO',
        'ABUDHABI',
        'AC',
        'ACADEMY',
        'ACCENTURE',
        'ACCOUNTANT',
        'ACCOUNTANTS',
        'ACO',
        'ACTIVE',
        'ACTOR',
        'AD',
        'ADAC',
        'ADS',
        'ADULT',
        'AE',
        'AEG',
        'AERO',
        'AF',
        'AFL',
        'AG',
        'AGAKHAN',
        'AGENCY',
        'AI',
        'AIG',
        'AIRFORCE',
        'AIRTEL',
        'AKDN',
        'AL',
        'ALIBABA',
        'ALIPAY',
        'ALLFINANZ',
        'ALLY',
        'ALSACE',
        'AM',
        'AMICA',
        'AMSTERDAM',
        'ANALYTICS',
        'ANDROID',
        'ANQUAN',
        'AO',
        'APARTMENTS',
        'APP',
        'APPLE',
        'AQ',
        'AQUARELLE',
        'AR',
        'ARAMCO',
        'ARCHI',
        'ARMY',
        'ARPA',
        'ARTE',
        'AS',
        'ASIA',
        'ASSOCIATES',
        'AT',
        'ATTORNEY',
        'AU',
        'AUCTION',
        'AUDI',
        'AUDIO',
        'AUTHOR',
        'AUTO',
        'AUTOS',
        'AVIANCA',
        'AW',
        'AWS',
        'AX',
        'AXA',
        'AZ',
        'AZURE',
        'BA',
        'BABY',
        'BAIDU',
        'BAND',
        'BANK',
        'BAR',
        'BARCELONA',
        'BARCLAYCARD',
        'BARCLAYS',
        'BAREFOOT',
        'BARGAINS',
        'BAUHAUS',
        'BAYERN',
        'BB',
        'BBC',
        'BBVA',
        'BCG',
        'BCN',
        'BD',
        'BE',
        'BEATS',
        'BEER',
        'BENTLEY',
        'BERLIN',
        'BEST',
        'BET',
        'BF',
        'BG',
        'BH',
        'BHARTI',
        'BI',
        'BIBLE',
        'BID',
        'BIKE',
        'BING',
        'BINGO',
        'BIO',
        'BIZ',
        'BJ',
        'BLACK',
        'BLACKFRIDAY',
        'BLOOMBERG',
        'BLUE',
        'BM',
        'BMS',
        'BMW',
        'BN',
        'BNL',
        'BNPPARIBAS',
        'BO',
        'BOATS',
        'BOEHRINGER',
        'BOM',
        'BOND',
        'BOO',
        'BOOK',
        'BOOTS',
        'BOSCH',
        'BOSTIK',
        'BOT',
        'BOUTIQUE',
        'BR',
        'BRADESCO',
        'BRIDGESTONE',
        'BROADWAY',
        'BROKER',
        'BROTHER',
        'BRUSSELS',
        'BS',
        'BT',
        'BUDAPEST',
        'BUGATTI',
        'BUILD',
        'BUILDERS',
        'BUSINESS',
        'BUY',
        'BUZZ',
        'BV',
        'BW',
        'BY',
        'BZ',
        'BZH',
        'CA',
        'CAB',
        'CAFE',
        'CAL',
        'CALL',
        'CAMERA',
        'CAMP',
        'CANCERRESEARCH',
        'CANON',
        'CAPETOWN',
        'CAPITAL',
        'CAR',
        'CARAVAN',
        'CARDS',
        'CARE',
        'CAREER',
        'CAREERS',
        'CARS',
        'CARTIER',
        'CASA',
        'CASH',
        'CASINO',
        'CAT',
        'CATERING',
        'CBA',
        'CBN',
        'CC',
        'CD',
        'CEB',
        'CENTER',
        'CEO',
        'CERN',
        'CF',
        'CFA',
        'CFD',
        'CG',
        'CH',
        'CHANEL',
        'CHANNEL',
        'CHASE',
        'CHAT',
        'CHEAP',
        'CHLOE',
        'CHRISTMAS',
        'CHROME',
        'CHURCH',
        'CI',
        'CIPRIANI',
        'CIRCLE',
        'CISCO',
        'CITIC',
        'CITY',
        'CITYEATS',
        'CK',
        'CL',
        'CLAIMS',
        'CLEANING',
        'CLICK',
        'CLINIC',
        'CLINIQUE',
        'CLOTHING',
        'CLOUD',
        'CLUB',
        'CLUBMED',
        'CM',
        'CN',
        'CO',
        'COACH',
        'CODES',
        'COFFEE',
        'COLLEGE',
        'COLOGNE',
        'COM',
        'COMMBANK',
        'COMMUNITY',
        'COMPANY',
        'COMPARE',
        'COMPUTER',
        'COMSEC',
        'CONDOS',
        'CONSTRUCTION',
        'CONSULTING',
        'CONTACT',
        'CONTRACTORS',
        'COOKING',
        'COOL',
        'COOP',
        'CORSICA',
        'COUNTRY',
        'COUPON',
        'COUPONS',
        'COURSES',
        'CR',
        'CREDIT',
        'CREDITCARD',
        'CREDITUNION',
        'CRICKET',
        'CROWN',
        'CRS',
        'CRUISES',
        'CSC',
        'CU',
        'CUISINELLA',
        'CV',
        'CW',
        'CX',
        'CY',
        'CYMRU',
        'CYOU',
        'CZ',
        'DABUR',
        'DAD',
        'DANCE',
        'DATE',
        'DATING',
        'DATSUN',
        'DAY',
        'DCLK',
        'DE',
        'DEALER',
        'DEALS',
        'DEGREE',
        'DELIVERY',
        'DELL',
        'DELOITTE',
        'DELTA',
        'DEMOCRAT',
        'DENTAL',
        'DENTIST',
        'DESI',
        'DESIGN',
        'DEV',
        'DIAMONDS',
        'DIET',
        'DIGITAL',
        'DIRECT',
        'DIRECTORY',
        'DISCOUNT',
        'DJ',
        'DK',
        'DM',
        'DNP',
        'DO',
        'DOCS',
        'DOG',
        'DOHA',
        'DOMAINS',
        'DOWNLOAD',
        'DRIVE',
        'DUBAI',
        'DURBAN',
        'DVAG',
        'DZ',
        'EARTH',
        'EAT',
        'EC',
        'EDEKA',
        'EDU',
        'EDUCATION',
        'EE',
        'EG',
        'EMAIL',
        'EMERCK',
        'ENERGY',
        'ENGINEER',
        'ENGINEERING',
        'ENTERPRISES',
        'EPSON',
        'EQUIPMENT',
        'ER',
        'ERNI',
        'ES',
        'ESQ',
        'ESTATE',
        'ET',
        'EU',
        'EUROVISION',
        'EUS',
        'EVENTS',
        'EVERBANK',
        'EXCHANGE',
        'EXPERT',
        'EXPOSED',
        'EXPRESS',
        'EXTRASPACE',
        'FAGE',
        'FAIL',
        'FAIRWINDS',
        'FAITH',
        'FAMILY',
        'FAN',
        'FANS',
        'FARM',
        'FASHION',
        'FAST',
        'FEEDBACK',
        'FERRERO',
        'FI',
        'FILM',
        'FINAL',
        'FINANCE',
        'FINANCIAL',
        'FIRESTONE',
        'FIRMDALE',
        'FISH',
        'FISHING',
        'FIT',
        'FITNESS',
        'FJ',
        'FK',
        'FLICKR',
        'FLIGHTS',
        'FLORIST',
        'FLOWERS',
        'FLSMIDTH',
        'FLY',
        'FM',
        'FO',
        'FOO',
        'FOOTBALL',
        'FORD',
        'FOREX',
        'FORSALE',
        'FORUM',
        'FOUNDATION',
        'FOX',
        'FR',
        'FRESENIUS',
        'FRL',
        'FROGANS',
        'FRONTIER',
        'FTR',
        'FUND',
        'FURNITURE',
        'FUTBOL',
        'FYI',
        'GA',
        'GAL',
        'GALLERY',
        'GALLO',
        'GALLUP',
        'GAME',
        'GARDEN',
        'GB',
        'GBIZ',
        'GD',
        'GDN',
        'GE',
        'GEA',
        'GENT',
        'GENTING',
        'GF',
        'GG',
        'GGEE',
        'GH',
        'GI',
        'GIFT',
        'GIFTS',
        'GIVES',
        'GIVING',
        'GL',
        'GLASS',
        'GLE',
        'GLOBAL',
        'GLOBO',
        'GM',
        'GMAIL',
        'GMBH',
        'GMO',
        'GMX',
        'GN',
        'GOLD',
        'GOLDPOINT',
        'GOLF',
        'GOO',
        'GOOG',
        'GOOGLE',
        'GOP',
        'GOT',
        'GOV',
        'GP',
        'GQ',
        'GR',
        'GRAINGER',
        'GRAPHICS',
        'GRATIS',
        'GREEN',
        'GRIPE',
        'GROUP',
        'GS',
        'GT',
        'GU',
        'GUCCI',
        'GUGE',
        'GUIDE',
        'GUITARS',
        'GURU',
        'GW',
        'GY',
        'HAMBURG',
        'HANGOUT',
        'HAUS',
        'HDFCBANK',
        'HEALTH',
        'HEALTHCARE',
        'HELP',
        'HELSINKI',
        'HERE',
        'HERMES',
        'HIPHOP',
        'HITACHI',
        'HIV',
        'HK',
        'HM',
        'HN',
        'HOCKEY',
        'HOLDINGS',
        'HOLIDAY',
        'HOMEDEPOT',
        'HOMES',
        'HONDA',
        'HORSE',
        'HOST',
        'HOSTING',
        'HOTELES',
        'HOTMAIL',
        'HOUSE',
        'HOW',
        'HR',
        'HSBC',
        'HT',
        'HTC',
        'HU',
        'HYUNDAI',
        'IBM',
        'ICBC',
        'ICE',
        'ICU',
        'ID',
        'IE',
        'IFM',
        'IINET',
        'IL',
        'IM',
        'IMAMAT',
        'IMMO',
        'IMMOBILIEN',
        'IN',
        'INDUSTRIES',
        'INFINITI',
        'INFO',
        'ING',
        'INK',
        'INSTITUTE',
        'INSURANCE',
        'INSURE',
        'INT',
        'INTERNATIONAL',
        'INVESTMENTS',
        'IO',
        'IPIRANGA',
        'IQ',
        'IR',
        'IRISH',
        'IS',
        'ISELECT',
        'ISMAILI',
        'IST',
        'ISTANBUL',
        'IT',
        'ITAU',
        'IWC',
        'JAGUAR',
        'JAVA',
        'JCB',
        'JCP',
        'JE',
        'JETZT',
        'JEWELRY',
        'JLC',
        'JLL',
        'JM',
        'JMP',
        'JNJ',
        'JO',
        'JOBS',
        'JOBURG',
        'JOT',
        'JOY',
        'JP',
        'JPMORGAN',
        'JPRS',
        'JUEGOS',
        'KAUFEN',
        'KDDI',
        'KE',
        'KERRYHOTELS',
        'KERRYLOGISTICS',
        'KERRYPROPERTIES',
        'KFH',
        'KG',
        'KH',
        'KI',
        'KIA',
        'KIM',
        'KINDER',
        'KITCHEN',
        'KIWI',
        'KM',
        'KN',
        'KOELN',
        'KOMATSU',
        'KP',
        'KPMG',
        'KPN',
        'KR',
        'KRD',
        'KRED',
        'KUOKGROUP',
        'KW',
        'KY',
        'KYOTO',
        'KZ',
        'LA',
        'LACAIXA',
        'LAMBORGHINI',
        'LAMER',
        'LANCASTER',
        'LAND',
        'LANDROVER',
        'LANXESS',
        'LASALLE',
        'LAT',
        'LATROBE',
        'LAW',
        'LAWYER',
        'LB',
        'LC',
        'LDS',
        'LEASE',
        'LECLERC',
        'LEGAL',
        'LEXUS',
        'LGBT',
        'LI',
        'LIAISON',
        'LIDL',
        'LIFE',
        'LIFEINSURANCE',
        'LIFESTYLE',
        'LIGHTING',
        'LIKE',
        'LIMITED',
        'LIMO',
        'LINCOLN',
        'LINDE',
        'LINK',
        'LIPSY',
        'LIVE',
        'LIVING',
        'LIXIL',
        'LK',
        'LOAN',
        'LOANS',
        'LOCUS',
        'LOL',
        'LONDON',
        'LOTTE',
        'LOTTO',
        'LOVE',
        'LR',
        'LS',
        'LT',
        'LTD',
        'LTDA',
        'LU',
        'LUPIN',
        'LUXE',
        'LUXURY',
        'LV',
        'LY',
        'MA',
        'MADRID',
        'MAIF',
        'MAISON',
        'MAKEUP',
        'MAN',
        'MANAGEMENT',
        'MANGO',
        'MARKET',
        'MARKETING',
        'MARKETS',
        'MARRIOTT',
        'MBA',
        'MC',
        'MD',
        'ME',
        'MED',
        'MEDIA',
        'MEET',
        'MELBOURNE',
        'MEME',
        'MEMORIAL',
        'MEN',
        'MENU',
        'MEO',
        'MG',
        'MH',
        'MIAMI',
        'MICROSOFT',
        'MIL',
        'MINI',
        'MK',
        'ML',
        'MLS',
        'MM',
        'MMA',
        'MN',
        'MO',
        'MOBI',
        'MOBILY',
        'MODA',
        'MOE',
        'MOI',
        'MOM',
        'MONASH',
        'MONEY',
        'MONTBLANC',
        'MORMON',
        'MORTGAGE',
        'MOSCOW',
        'MOTORCYCLES',
        'MOV',
        'MOVIE',
        'MOVISTAR',
        'MP',
        'MQ',
        'MR',
        'MS',
        'MT',
        'MTN',
        'MTPC',
        'MTR',
        'MU',
        'MUSEUM',
        'MUTUAL',
        'MUTUELLE',
        'MV',
        'MW',
        'MX',
        'MY',
        'MZ',
        'NA',
        'NADEX',
        'NAGOYA',
        'NAME',
        'NATURA',
        'NAVY',
        'NC',
        'NE',
        'NEC',
        'NET',
        'NETBANK',
        'NETWORK',
        'NEUSTAR',
        'NEW',
        'NEWS',
        'NEXT',
        'NEXTDIRECT',
        'NEXUS',
        'NF',
        'NG',
        'NGO',
        'NHK',
        'NI',
        'NICO',
        'NIKON',
        'NINJA',
        'NISSAN',
        'NISSAY',
        'NL',
        'NO',
        'NOKIA',
        'NORTHWESTERNMUTUAL',
        'NORTON',
        'NOWRUZ',
        'NP',
        'NR',
        'NRA',
        'NRW',
        'NTT',
        'NU',
        'NYC',
        'NZ',
        'OBI',
        'OFFICE',
        'OKINAWA',
        'OLAYAN',
        'OLAYANGROUP',
        'OM',
        'OMEGA',
        'ONE',
        'ONG',
        'ONL',
        'ONLINE',
        'OOO',
        'ORACLE',
        'ORANGE',
        'ORG',
        'ORGANIC',
        'ORIGINS',
        'OSAKA',
        'OTSUKA',
        'OVH',
        'PA',
        'PAGE',
        'PAMPEREDCHEF',
        'PANERAI',
        'PARIS',
        'PARS',
        'PARTNERS',
        'PARTS',
        'PARTY',
        'PASSAGENS',
        'PE',
        'PET',
        'PF',
        'PG',
        'PH',
        'PHARMACY',
        'PHILIPS',
        'PHOTO',
        'PHOTOGRAPHY',
        'PHOTOS',
        'PHYSIO',
        'PIAGET',
        'PICS',
        'PICTET',
        'PICTURES',
        'PID',
        'PIN',
        'PING',
        'PINK',
        'PIZZA',
        'PK',
        'PL',
        'PLACE',
        'PLAY',
        'PLAYSTATION',
        'PLUMBING',
        'PLUS',
        'PM',
        'PN',
        'POHL',
        'POKER',
        'PORN',
        'POST',
        'PR',
        'PRAXI',
        'PRESS',
        'PRO',
        'PROD',
        'PRODUCTIONS',
        'PROF',
        'PROGRESSIVE',
        'PROMO',
        'PROPERTIES',
        'PROPERTY',
        'PROTECTION',
        'PS',
        'PT',
        'PUB',
        'PW',
        'PWC',
        'PY',
        'QA',
        'QPON',
        'QUEBEC',
        'QUEST',
        'RACING',
        'RE',
        'READ',
        'REALTOR',
        'REALTY',
        'RECIPES',
        'RED',
        'REDSTONE',
        'REDUMBRELLA',
        'REHAB',
        'REISE',
        'REISEN',
        'REIT',
        'REN',
        'RENT',
        'RENTALS',
        'REPAIR',
        'REPORT',
        'REPUBLICAN',
        'REST',
        'RESTAURANT',
        'REVIEW',
        'REVIEWS',
        'REXROTH',
        'RICH',
        'RICOH',
        'RIO',
        'RIP',
        'RO',
        'ROCHER',
        'ROCKS',
        'RODEO',
        'ROOM',
        'RS',
        'RSVP',
        'RU',
        'RUHR',
        'RUN',
        'RW',
        'RWE',
        'RYUKYU',
        'SA',
        'SAARLAND',
        'SAFE',
        'SAFETY',
        'SAKURA',
        'SALE',
        'SALON',
        'SAMSUNG',
        'SANDVIK',
        'SANDVIKCOROMANT',
        'SANOFI',
        'SAP',
        'SAPO',
        'SARL',
        'SAS',
        'SAXO',
        'SB',
        'SBI',
        'SBS',
        'SC',
        'SCA',
        'SCB',
        'SCHAEFFLER',
        'SCHMIDT',
        'SCHOLARSHIPS',
        'SCHOOL',
        'SCHULE',
        'SCHWARZ',
        'SCIENCE',
        'SCOR',
        'SCOT',
        'SD',
        'SE',
        'SEAT',
        'SECURITY',
        'SEEK',
        'SELECT',
        'SENER',
        'SERVICES',
        'SEVEN',
        'SEW',
        'SEX',
        'SEXY',
        'SFR',
        'SG',
        'SH',
        'SHARP',
        'SHAW',
        'SHELL',
        'SHIA',
        'SHIKSHA',
        'SHOES',
        'SHOUJI',
        'SHOW',
        'SHRIRAM',
        'SI',
        'SINA',
        'SINGLES',
        'SITE',
        'SJ',
        'SK',
        'SKI',
        'SKIN',
        'SKY',
        'SKYPE',
        'SL',
        'SM',
        'SMILE',
        'SN',
        'SNCF',
        'SO',
        'SOCCER',
        'SOCIAL',
        'SOFTBANK',
        'SOFTWARE',
        'SOHU',
        'SOLAR',
        'SOLUTIONS',
        'SONG',
        'SONY',
        'SOY',
        'SPACE',
        'SPIEGEL',
        'SPOT',
        'SPREADBETTING',
        'SR',
        'SRL',
        'ST',
        'STADA',
        'STAR',
        'STARHUB',
        'STATEBANK',
        'STATEFARM',
        'STATOIL',
        'STC',
        'STCGROUP',
        'STOCKHOLM',
        'STORAGE',
        'STORE',
        'STREAM',
        'STUDIO',
        'STUDY',
        'STYLE',
        'SU',
        'SUCKS',
        'SUPPLIES',
        'SUPPLY',
        'SUPPORT',
        'SURF',
        'SURGERY',
        'SUZUKI',
        'SV',
        'SWATCH',
        'SWISS',
        'SX',
        'SY',
        'SYDNEY',
        'SYMANTEC',
        'SYSTEMS',
        'SZ',
        'TAB',
        'TAIPEI',
        'TALK',
        'TAOBAO',
        'TATAMOTORS',
        'TATAR',
        'TATTOO',
        'TAX',
        'TAXI',
        'TC',
        'TCI',
        'TD',
        'TEAM',
        'TECH',
        'TECHNOLOGY',
        'TEL',
        'TELECITY',
        'TELEFONICA',
        'TEMASEK',
        'TENNIS',
        'TEVA',
        'TF',
        'TG',
        'TH',
        'THD',
        'THEATER',
        'THEATRE',
        'TICKETS',
        'TIENDA',
        'TIFFANY',
        'TIPS',
        'TIRES',
        'TIROL',
        'TJ',
        'TK',
        'TL',
        'TM',
        'TMALL',
        'TN',
        'TO',
        'TODAY',
        'TOKYO',
        'TOOLS',
        'TOP',
        'TORAY',
        'TOSHIBA',
        'TOTAL',
        'TOURS',
        'TOWN',
        'TOYOTA',
        'TOYS',
        'TR',
        'TRADE',
        'TRADING',
        'TRAINING',
        'TRAVEL',
        'TRAVELERS',
        'TRAVELERSINSURANCE',
        'TRUST',
        'TRV',
        'TT',
        'TUBE',
        'TUI',
        'TUNES',
        'TUSHU',
        'TV',
        'TVS',
        'TW',
        'TZ',
        'UA',
        'UBS',
        'UG',
        'UK',
        'UNICOM',
        'UNIVERSITY',
        'UNO',
        'UOL',
        'US',
        'UY',
        'UZ',
        'VA',
        'VACATIONS',
        'VANA',
        'VC',
        'VE',
        'VEGAS',
        'VENTURES',
        'VERISIGN',
        'VERSICHERUNG',
        'VET',
        'VG',
        'VI',
        'VIAJES',
        'VIDEO',
        'VIG',
        'VIKING',
        'VILLAS',
        'VIN',
        'VIP',
        'VIRGIN',
        'VISION',
        'VISTA',
        'VISTAPRINT',
        'VIVA',
        'VLAANDEREN',
        'VN',
        'VODKA',
        'VOLKSWAGEN',
        'VOTE',
        'VOTING',
        'VOTO',
        'VOYAGE',
        'VU',
        'VUELOS',
        'WALES',
        'WALTER',
        'WANG',
        'WANGGOU',
        'WARMAN',
        'WATCH',
        'WATCHES',
        'WEATHER',
        'WEATHERCHANNEL',
        'WEBCAM',
        'WEBER',
        'WEBSITE',
        'WED',
        'WEDDING',
        'WEIBO',
        'WEIR',
        'WF',
        'WHOSWHO',
        'WIEN',
        'WIKI',
        'WILLIAMHILL',
        'WIN',
        'WINDOWS',
        'WINE',
        'WME',
        'WOLTERSKLUWER',
        'WORK',
        'WORKS',
        'WORLD',
        'WS',
        'WTC',
        'WTF',
        'XBOX',
        'XEROX',
        'XIHUAN',
        'XIN',
        'XN--11B4C3D',
        'XN--1CK2E1B',
        'XN--1QQW23A',
        'XN--30RR7Y',
        'XN--3BST00M',
        'XN--3DS443G',
        'XN--3E0B707E',
        'XN--3PXU8K',
        'XN--42C2D9A',
        'XN--45BRJ9C',
        'XN--45Q11C',
        'XN--4GBRIM',
        'XN--55QW42G',
        'XN--55QX5D',
        'XN--5TZM5G',
        'XN--6FRZ82G',
        'XN--6QQ986B3XL',
        'XN--80ADXHKS',
        'XN--80AO21A',
        'XN--80ASEHDB',
        'XN--80ASWG',
        'XN--8Y0A063A',
        'XN--90A3AC',
        'XN--90AIS',
        'XN--9DBQ2A',
        'XN--9ET52U',
        'XN--9KRT00A',
        'XN--B4W605FERD',
        'XN--BCK1B9A5DRE4C',
        'XN--C1AVG',
        'XN--C2BR7G',
        'XN--CCK2B3B',
        'XN--CG4BKI',
        'XN--CLCHC0EA0B2G2A9GCD',
        'XN--CZR694B',
        'XN--CZRS0T',
        'XN--CZRU2D',
        'XN--D1ACJ3B',
        'XN--D1ALF',
        'XN--E1A4C',
        'XN--ECKVDTC9D',
        'XN--EFVY88H',
        'XN--ESTV75G',
        'XN--FCT429K',
        'XN--FHBEI',
        'XN--FIQ228C5HS',
        'XN--FIQ64B',
        'XN--FIQS8S',
        'XN--FIQZ9S',
        'XN--FJQ720A',
        'XN--FLW351E',
        'XN--FPCRJ9C3D',
        'XN--FZC2C9E2C',
        'XN--G2XX48C',
        'XN--GCKR3F0F',
        'XN--GECRJ9C',
        'XN--H2BRJ9C',
        'XN--HXT814E',
        'XN--I1B6B1A6A2E',
        'XN--IMR513N',
        'XN--IO0A7I',
        'XN--J1AEF',
        'XN--J1AMH',
        'XN--J6W193G',
        'XN--JLQ61U9W7B',
        'XN--JVR189M',
        'XN--KCRX77D1X4A',
        'XN--KPRW13D',
        'XN--KPRY57D',
        'XN--KPU716F',
        'XN--KPUT3I',
        'XN--L1ACC',
        'XN--LGBBAT1AD8J',
        'XN--MGB9AWBF',
        'XN--MGBA3A3EJT',
        'XN--MGBA3A4F16A',
        'XN--MGBA7C0BBN0A',
        'XN--MGBAAM7A8H',
        'XN--MGBAB2BD',
        'XN--MGBAYH7GPA',
        'XN--MGBB9FBPOB',
        'XN--MGBBH1A71E',
        'XN--MGBC0A9AZCG',
        'XN--MGBCA7DZDO',
        'XN--MGBERP4A5D4AR',
        'XN--MGBPL2FH',
        'XN--MGBT3DHD',
        'XN--MGBTX2B',
        'XN--MGBX4CD0AB',
        'XN--MIX891F',
        'XN--MK1BU44C',
        'XN--MXTQ1M',
        'XN--NGBC5AZD',
        'XN--NGBE9E0A',
        'XN--NODE',
        'XN--NQV7F',
        'XN--NQV7FS00EMA',
        'XN--NYQY26A',
        'XN--O3CW4H',
        'XN--OGBPF8FL',
        'XN--P1ACF',
        'XN--P1AI',
        'XN--PBT977C',
        'XN--PGBS0DH',
        'XN--PSSY2U',
        'XN--Q9JYB4C',
        'XN--QCKA1PMC',
        'XN--QXAM',
        'XN--RHQV96G',
        'XN--ROVU88B',
        'XN--S9BRJ9C',
        'XN--SES554G',
        'XN--T60B56A',
        'XN--TCKWE',
        'XN--UNUP4Y',
        'XN--VERMGENSBERATER-CTB',
        'XN--VERMGENSBERATUNG-PWB',
        'XN--VHQUV',
        'XN--VUQ861B',
        'XN--W4R85EL8FHU5DNRA',
        'XN--WGBH1C',
        'XN--WGBL6A',
        'XN--XHQ521B',
        'XN--XKC2AL3HYE2A',
        'XN--XKC2DL3A5EE0H',
        'XN--Y9A3AQ',
        'XN--YFRO4I67O',
        'XN--YGBI2AMMX',
        'XN--ZFR164B',
        'XPERIA',
        'XXX',
        'XYZ',
        'YACHTS',
        'YAHOO',
        'YAMAXUN',
        'YANDEX',
        'YE',
        'YODOBASHI',
        'YOGA',
        'YOKOHAMA',
        'YOU',
        'YOUTUBE',
        'YT',
        'YUN',
        'ZA',
        'ZARA',
        'ZERO',
        'ZIP',
        'ZM',
        'ZONE',
        'ZUERICH',
        'ZW'
        );

  preg_match("`(?<=\.)\w+$`", $domain, $tld); {
            return $tld['0'];
        }
        return false;
        }


public function GoogleBL($domain,$api_key,$searchengine_id){
        //function to find numbers of back links from domain name
	$ctx = stream_context_create(array('http'=>array('timeout' => 5,)));//1200 Seconds is 20 Minutes
	$url="http://www.".$domain;
	file_get_contents($url, false, $ctx);
	if(isset($http_response_header))
	{
		$string=$http_response_header['0'];
		$status=explode(' ', $string);
		$status=$status['1'];
		if ($status=="200")
		{

        $search_query = "link:$domain";
        $array=array(); $url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=$search_query&fields=items/link,searchInformation/totalResults";
        $google_search = file_get_contents($url);
        $seo_data=json_decode($google_search,true);

        if($seo_data['searchInformation']['totalResults']!=NULL)
        {
            return $seo_data;
        }
		}
        else
        {
        	echo '<div class="alert alert-danger alert-dismissable" >
			    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="ion-sad"></i>'.$status.'</div>';
			  }
	}
    }
    /*
public function GoogleBL_Count($domain){
        //function to find numbers of back links from domain name

        $search_query = "link:$domain";
        $array=array(); $url="https://www.googleapis.com/customsearch/v1?key=$this->api_key&cx=$this->searchengine_id&num=10&q=$search_query";
        $google_search = file_get_contents($url);
        $seo_data=json_decode($google_search,true);

        if($seo_data['queries']['request']['0']['totalResults']!=NULL)
        {


            return $seo_data['queries']['request']['0']['totalResults'];
            //  return $seo_data;
        }
    }

    public function Googlesearch($keyword,$start='0',$limit='10'){
    	//function to find numbers of back links from domain name


    	$array=array(); $url="https://www.googleapis.com/customsearch/v1?key=$this->api_key&cx=$this->searchengine_id&start=$start&num=$limit&q=$keyword";
    	$google_search = file_get_contents($url);
    	$seo_data=json_decode($google_search,true);

    	if($seo_data['queries']['request']['0']['totalResults']!=NULL)
    	{


    		//  return $seo['queries']['request']['0']['totalResults'];
    		return $seo_data;
    	}
    }

public function GoogleIP($domain)
    {
    //function to find numbers of index pages from domain name

        $search_query = "site:$domain";
        $url="https://www.googleapis.com/customsearch/v1?key=$this->api_key&cx=$this->searchengine_id&num=10&q=$search_query";
        $google_search = file_get_contents($url);
        $seo_data=json_decode($google_search,true);

        if($seo_data['queries']['request']['0']['totalResults']!=NULL)
            return $seo_data['queries']['request']['0']['totalResults'];
    }*/
  public function CheckGoogleIndexStatus($backlink_url,$api_key,$searchengine_id)
    {

            $search_query = "site:".$backlink_url;
    $url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=$search_query";
        $google_search = file_get_contents($url);
        $seo_data=json_decode($google_search,true);


       if($seo_data['queries']['request']['0']['totalResults']!=NULL &&  $seo_data['queries']['request']['0']['totalResults']!=0)
       {
           // return $seo_data['queries']['request']['0']['totalResults'];
           return "Indexed";
       }else
       {
       	$url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=".$search_query."&searchType=image";
       	$google_search = file_get_contents($url);
       	$seo_data=json_decode($google_search,true);
       	if($seo_data['queries']['request']['0']['totalResults']!=NULL &&$seo_data['queries']['request']['0']['totalResults']!=0)
       	{
       		return "Indexed";
       	}
       	else{

		        $domain=self::get_domain($backlink_url);
		       	$domain="http://www.".$domain;
		       	$search_query = "site:$domain";
		       	  $url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=$search_query";
		       	$google_search = file_get_contents($url);
		       	$seo_data=json_decode($google_search,true);
		       	if($seo_data['queries']['request']['0']['totalResults']!=NULL &&  $seo_data['queries']     ['request']['0']['totalResults']!=0)
		       	{
		       		// return $seo_data['queries']['request']['0']['totalResults'];
		       		return "PNI";
		       	}else{$url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=".$search_query."&searchType=image";
		       	$google_search = file_get_contents($url);
		       	$seo_data=json_decode($google_search,true);
		       	if($seo_data['queries']['request']['0']['totalResults']!=NULL &&  $seo_data['queries']     ['request']['0']['totalResults']!=0)
		       	{
		       		// return $seo_data['queries']['request']['0']['totalResults'];
		       		return "PNI";
		       	}else
		       	{
		       		return "DNI";
		       	}}

       }
       }
    }
public function GetDomainCompetitors($domain){
        //function to find numbers of competitiors from domain name. this function return an array of competitors

       $url="http://widget.semrush.com/widget.php?action=report&type=organic_organic&db=co.in&domain=$domain";
       $google_search = file_get_contents($url);
       $seo_data=json_decode($google_search,true);

    $c_array=array();

      if (is_array($seo_data['organic_organic']['data']))
  {
      foreach ($seo_data['organic_organic']['data'] as $key=>$value)
      {
       $com=$seo_data['organic_organic']['data'][$key]['Dn'];
       array_push($c_array, $com);

      }
      return $c_array;
  }
 return false;
    }
    public function GetDomainkeywords($domain){
        //function to find an array of keywords for domain name
    	//$domain="http://".$domain;
        $url="http://widget.semrush.com/widget.php?action=report&type=organic&db=co.in&domain=$domain";
        $google_search = file_get_contents($url);
        $seo_data=json_decode($google_search,true);

        $c_array=array();

        if (is_array($seo_data['organic']['data']))
        {
           /* foreach ($seo_data['organic_organic']['data'] as $key=>$value)
            {
                $com=$seo_data['organic_organic']['data'][$key]['Dn'];
                array_push($c_array, $com);

            }*/
            $c_array=$seo_data['organic']['data'];
            return $c_array;
        }
        return false;
    }
public function get_domain($url)
    {
        //function to get domain name from backlink or url
        $pieces = parse_url($url);
        $domain = isset($pieces['host']) ? $pieces['host'] : '';
        if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
            return $regs['domain'];
        }
        return false;
    }


function getLocationInfoByIp($ip){
    //function to return country name of given $ipaddress

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
    if($ip_data && $ip_data->geoplugin_countryName != null){
        $result['country'] = $ip_data->geoplugin_countryCode;
        $result['city'] = $ip_data->geoplugin_city;
    }
    $country_short=$result['country'];
    $country_name=Locale::getDisplayRegion('sl-Latn-'.$country_short.'-nedis', 'en');
    return $country_name;
}
function getipInfoBydomain($domain){
//function to return ipaddress of given domain name
    $ipaddress=gethostbyname($domain);
    return $ipaddress;
}

public function get_backlink_status($url,$domain) {
$ctx = stream_context_create(array('http'=>array('timeout' => 5,)));//1200 Seconds is 20 Minutes

file_get_contents($url, false, $ctx);
if(isset($http_response_header))
{
	$string=$http_response_header['0'];
	$status=explode(' ', $string);
    $status=$status['1'];
	if ($status=="200")
	{
$html = file_get_contents($url);//Create a new DOM document
if(strlen($html)>0){
	$str = trim(preg_replace('/\s+/', ' ', $html)); // supports line breaks inside <title>
	preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
	$title=$title[1];}
$dom = new DOMDocument;

//Parse the HTML. The @ is used to suppress any parsing errors
//that will be thrown if the $html string isn't valid XHTML.
@$dom->loadHTML($html);

//Get all links. You could also use any other tag name here,
//like 'img' or 'table', to extract other tags.
$output = array();
$find="0";
foreach ($dom->getElementsByTagName('a') as $item)
     {
        if (strstr($item->getAttribute('href'), $domain))
			   {
			   	if ($item->getAttribute('rel')=="nofollow")
			   	{
			   		$s1="NF";
			   	}else
			   	{
			   		$s1="F";
			   	}
			     return $output[] = array ('str' => $dom->saveHTML($item),
											'href' => $item->getAttribute('href'),
											'rel' => $s1,
			     		                    'title'=>$title,
											'anchorText' => $item->nodeValue);


				$find="1";
				break;
			   }

       }
       if($find=="0")
       {
       	return $output[] = array ('str' => "",
					   			   'href' => "",
					   			   'rel' => "BNF",
       			                   'title'=>$title,
					   			   'anchorText' => "");

       }

}
else
{

	return $output[] = array ('str' => "",
							  'href' => "",
							  'rel' => $status,
			                  'title'=>$title,
							  'anchorText' => "");

}
}else{
      return $output[] = array ('str' => "",
				        		 'href' => "",
				        		 'rel' => "SD",
      		                     'title'=>$title,
				        		 'anchorText' => "");
    }


}
public function getfavicon($url){
    $favicon = '';
    $html = file_get_contents($url);

    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $links = $dom->getElementsByTagName('link');

    for ($i = 0; $i < $links->length; $i++){

         $link = $links->item($i);
        if($link->getAttribute('rel') == 'mask-icon' || $link->getAttribute('rel') == 'icon'
                                                     || $link->getAttribute('rel') == 'apple-touch-icon'
                                                     || $link->getAttribute('rel') == 'shortcut icon'){

            $favicon = $link->getAttribute('href');
	}
    }
    return $favicon;
}
public function GetKeywordPositionByDomain($keyword,$search_engine,$api_key,$searchengine_id)
{

	$search_query = urlencode($keyword);
	$num=99;
	$count=1;
	$new_array=array();
	for($i=0;$i<$num;$i=$i+10)
	{
		if($i==0)
	        $url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&q=$search_query&googlehost=$search_engine&fields=items/link";
	   else
		$url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&q=$search_query&start=$i&googlehost=$search_engine&fields=items/link";


		$google_search = file_get_contents($url);
		$seo_data=json_decode($google_search,true);

if (is_array($seo_data)){
		foreach($seo_data['items'] as $key=>$value)
	     {
	     	$sd=self::get_domain($seo_data['items'][$key]['link']);
	        array_push($new_array, $sd);
         }
}
	}
if (!empty($new_array))
{
	return $new_array;
}
else
{
echo '<div class="alert alert-danger">
                   <button class="close" data-dismiss="alert" type="button"><i class="fa fa-times"></i></button>
                   <strong><i class="fa fa-smile-o"></i> Please Try after some time..</strong></div>';}

}

public function GoogleSpeedTest($domain,$api_key,$searchengine_id){
	//function to find numbers of back links from domain name

	$search_query = "http://".$domain;
	//$url="https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$searchengine_id&num=10&q=$search_query";
	$url="https://www.googleapis.com/pagespeedonline/v1/runPagespeed?url=$search_query&key=$api_key&cx=$searchengine_id";
	$google_search = file_get_contents($url);
	$speed_data=json_decode($google_search,true);

	if($speed_data['responseCode']=="200")
	{


		// return $seo_data['queries']['request']['0']['totalResults'];
		return $speed_data;
	}
}
public function is_valid_domain($url){

    $validation = FALSE;
    /*Parse URL*/
    $urlparts = parse_url(filter_var($url, FILTER_SANITIZE_URL));
    /*Check host exist else path assign to host*/
    if(!isset($urlparts['host'])){
        $urlparts['host'] = $urlparts['path'];
    }

    if($urlparts['host']!=''){
        /*Add scheme if not found*/
        if (!isset($urlparts['scheme'])){
            $urlparts['scheme'] = 'http';
        }
        /*Validation*/
        if(checkdnsrr($urlparts['host'], 'A') && in_array($urlparts['scheme'],array('http','https')) && ip2long($urlparts['host']) === FALSE){
            $urlparts['host'] = preg_replace('/^www\./', '', $urlparts['host']);
            $url = $urlparts['scheme'].'://'.$urlparts['host']. "/";

            if (filter_var($url, FILTER_VALIDATE_URL) !== false && @get_headers($url)) {
                $validation = TRUE;
            }
        }
    }

    if(!$validation){
        return false;

    }else{
        return true;
    }

}

public function nice_number($n) {
    // first strip any formatting;
    $n = (0+str_replace(",", "", $n));

    // is this a number?
    if (!is_numeric($n)) return false;

    // now filter it;
    if ($n > 1000000000000) return round(($n/1000000000000), 2).' T'; //trillion
    elseif ($n > 1000000000) return round(($n/1000000000), 2).' B'; //billion
    elseif ($n > 1000000) return round(($n/1000000), 2).' M';//million
    elseif ($n > 1000) return round(($n/1000), 2).' TH'; //thousand

    return number_format($n);
}
public function GetAlexaRank($domain)
{
	$url=$domain;
	$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$url);
	$rank=isset($xml->SD[1]->POPULARITY)?$xml->SD[1]->POPULARITY->attributes()->TEXT:0;
	$web=(string)$xml->SD[0]->attributes()->HOST;
	return $rank;


}

public function Get_Moz_Metrics($url, $accesskey, $secretkey)
{

//http://plano-garage-door.us===domain moz metrices
//http://www.plano-garage-door.us/plano garage/===backlink moz metrices

$accessID = $accesskey; // * Add unique Access ID
$secretKey = $secretkey; // * Add unique Secret Key
$expires = time() + 300;
$stringToSign = $accessID."\n".$expires;
$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
$urlSafeSignature = urlencode(base64_encode($binarySignature));
//$url="http://".USER_CURRENT_DOMAIN_NAME;
$objectURL =$url;// $_POST['url'];
$cols = "103079215140";
$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
$options = array(CURLOPT_RETURNTRANSFER => true);
$ch = curl_init($requestUrl);
curl_setopt_array($ch, $options);
$content = curl_exec($ch);
curl_close($ch);
$json_a = json_decode($content);

$pageAuthority = round($json_a->upa,0); // * Use the round() function to return integer
$domainAuthority = round($json_a->pda,0);
$externalLinks = $json_a->ueid;
$theUrl = $json_a->uu;
return array('da'=>$domainAuthority,'pa'=>$pageAuthority,'external_link'=>$externalLinks);

}
public function GetMozHttpstatus($url, $accesskey, $secretkey)
{

	//http://plano-garage-door.us===domain moz metrices
	//http://www.plano-garage-door.us/plano garage/===backlink moz metrices

	$accessID = $accesskey; // * Add unique Access ID
	$secretKey = $secretkey; // * Add unique Secret Key
	$expires = time() + 300;
	$stringToSign = $accessID."\n".$expires;
	$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
	$urlSafeSignature = urlencode(base64_encode($binarySignature));
	//$url="http://".USER_CURRENT_DOMAIN_NAME;
	$objectURL =$url;// $_POST['url'];
	$cols = "536870912";
	$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
	$options = array(CURLOPT_RETURNTRANSFER => true);
	$ch = curl_init($requestUrl);
	curl_setopt_array($ch, $options);
	$content = curl_exec($ch);
	curl_close($ch);
	$json_a = json_decode($content);

	$http_status = round($json_a->us,0); // * Use the round() function to return integer

	return $http_status;

}
public function getMozRank($url, $accesskey, $secretkey)
{

	//http://plano-garage-door.us===domain moz metrices
	//http://www.plano-garage-door.us/plano garage/===backlink moz metrices

	$accessID = $accesskey; // * Add unique Access ID
	$secretKey = $secretkey; // * Add unique Secret Key
	$expires = time() + 300;
	$stringToSign = $accessID."\n".$expires;
	$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
	$urlSafeSignature = urlencode(base64_encode($binarySignature));
	//$url="http://".USER_CURRENT_DOMAIN_NAME;
	$objectURL =$url;// $_POST['url'];
	$cols = "16384";
	$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
	$options = array(CURLOPT_RETURNTRANSFER => true);
	$ch = curl_init($requestUrl);
	curl_setopt_array($ch, $options);
	$content = curl_exec($ch);
	curl_close($ch);
	$json_a = json_decode($content);

    $mozrank = round($json_a->umrp,0); // * Use the round() function to return integer
return $mozrank;
}
public function getMozRankRaw($url, $accesskey, $secretkey)
{

	//http://plano-garage-door.us===domain moz metrices
	//http://www.plano-garage-door.us/plano garage/===backlink moz metrices

	$accessID = $accesskey; // * Add unique Access ID
	$secretKey = $secretkey; // * Add unique Secret Key
	$expires = time() + 300;
	$stringToSign = $accessID."\n".$expires;
	$binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);
	$urlSafeSignature = urlencode(base64_encode($binarySignature));
	//$url="http://".USER_CURRENT_DOMAIN_NAME;
	$objectURL =$url;// $_POST['url'];
	$cols = "16384";
	$requestUrl = "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($objectURL)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature;
	$options = array(CURLOPT_RETURNTRANSFER => true);
	$ch = curl_init($requestUrl);
	curl_setopt_array($ch, $options);
	$content = curl_exec($ch);
	curl_close($ch);
	$json_a = json_decode($content);

	$moz_row_rank = round($json_a->umrr,0);// * Use the round() function to return integer
	return $moz_row_rank;


}
public function get_fb($url) {
	$url='http://api.facebook.com/restserver.php?method=links.getStats&format=json&urls='.$url;

	$ch=curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_TIMEOUT, $this->timeout);
	$cont = curl_exec($ch);
	$json_string = $cont;
	$json = json_decode($json_string, true);
	return isset($json[0]['total_count'])?intval($json[0]['total_count']):0;
}
function get_plusones($url){
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
	curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
	$curl_results = curl_exec ($curl);
	curl_close ($curl);
	$json = json_decode($curl_results, true);
	return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
}


}

?>