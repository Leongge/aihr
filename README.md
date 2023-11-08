# AIHR

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

## Usage

1. Login
   ![image](https://github.com/Leongge/aihr/assets/143370605/8b951fae-ac5e-4bc9-a65e-c7f647592052)
2.Dashboard
   ![image](https://github.com/Leongge/aihr/assets/143370605/f705dd0e-8921-4d62-b654-1d06f7b0e1c2)
3. Record page
   ![image](https://github.com/Leongge/aihr/assets/143370605/77294ea6-2bc2-4a69-8b72-aa7e808c3960)
4. Record detail
   ![image](https://github.com/Leongge/aihr/assets/143370605/6b3dceb8-fffc-4f97-b1e5-d403e50a6226)
5. Job list
   ![image](https://github.com/Leongge/aihr/assets/143370605/bcb0e4c3-0935-4b39-bda5-2b6570200d14)
6. Add Job
   ![image](https://github.com/Leongge/aihr/assets/143370605/f678666b-094f-4bb5-a5ed-c995b5c89980)
7. Job Detail
   ![image](https://github.com/Leongge/aihr/assets/143370605/adf74ca6-f0fc-4f47-8af8-49d42c6699a1)
8. Logout
   ![image](https://github.com/Leongge/aihr/assets/143370605/47bb8a56-33ee-47c1-bb34-c3dc824d354b)

## Dev Team
> Khor Chun Leong

>  Ng Man Yew

>  Vincent Goh Kah Fung

>  Fong Yung Xin

### Current Version
> 1.0.0


