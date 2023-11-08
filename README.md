# AIHR

<details>
  <summary>Table of Contents</summary>
  <ol>
    <li><a href="#overview">overview</a></li>
    <li><a href="#built-with">Built with</a></li>
    <li><a href="#how-it-works">How It Works</a></li>
    <li><a href="#installation">Installation</a></li>
    <li><a href="#future-enhancement">Future Enhancement</a></li>
    <li><a href="#dev-team">Dev Team</a></li>
    <li><a href="#current-version">Current Version</a></li>
  </ol>
</details>

## Overview
AIHR is a solution to help enhance the efficiency of hiring process using Artificial Intelligence (AI). HR professionals can use this tool to streamline candidate assessment and improve the quality of candidate selection.

## Built with
- [![HTML5](https://img.shields.io/badge/html5-%23E34F26.svg?style=for-the-badge&logo=html5&logoColor=white)](https://html.com/html5/)
- [![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)
- [![JavaScript](https://img.shields.io/badge/javascript-%23323330.svg?style=for-the-badge&logo=javascript&logoColor=%23F7DF1E)](https://www.javascript.com/)
- [![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
- [![MySQL](https://img.shields.io/badge/mysql-%2300f.svg?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/)
- [![ChatGPT](https://img.shields.io/badge/chatGPT-74aa9c?style=for-the-badge&logo=openai&logoColor=white)](https://openai.com/)

## How It Works
1. **Job Setup**: HR administrators have the ability to define and set job requirements within the application. They can specify the skills, experience, education, and other qualifications needed for each job position.
2. **PDF Upload**: HR personnel can upload candidate resumes in PDF format.
3. **Text Extraction**: The PDF Parser component extracts the text content from the uploaded PDFs.
4. **Matching Algorithm**: The extracted candidate details are compared with the job requirements set by HR using a sophisticated matching algorithm tailored to each job position. This matching process is carried out on the backend (PHP) with the support of AI components.
5. **Compatibility Rating**: Each candidate is assigned a compatibility rating with the job they applied for based on the customized matching algorithm for that specific job.
6. **Ranked List**: The tool generates a ranked list of candidates in descending order of their compatibility with the job they applied for. HR professionals can easily identify the top candidates for each job opening.

## Installation
1. Install orhanerday package via composer:
```
composer require orhanerday/open-ai
```
<sup>references : https://github.com/orhanerday/open-ai</sup>

2. Install PDFParser package via composer :
```
composer require smalot/pdfparser
```
<sup>references : https://github.com/smalot/pdfparser</sup>

3. Get a API KEY from https://openai.com/pricing
4. Enter your API in .htaccess

```
SetEnv OPENAI_API_KEY 'your API key'
```

## Future Enhancement
1. Detailed Qualification Statistic for each candidates.
2. Integrate into existing HR system.
3. Add multiple file at once.

## Dev Team
> Khor Chun Leong

>  Ng Man Yew

>  Vincent Goh Kah Fung

>  Fong Yung Xin

### Current Version
> 1.0.0


