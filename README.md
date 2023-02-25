# WEBSITE FA 0214

## ATTENTION

- All the files and directories in this repository are belong to the Phyxle Infotech (Pvt) Ltd. So, don't share this source code with anyone and don't put this source code anywhere else other than this repository.
- This is the technical file of this project. So, don't edit or remove this file.
- Don't push anything to `master` or `source` branches. Create a new branch called `v1` (Case-sensitive) and push your code there. Also, don't forget to include this `README.md` file in `v1` branch.
- Create a file in `v1` branch, named `README-v1.md` to document your work.

## TECHNICAL REQUIREMENTS

Due to maintainability and quality of the project, you must follow these rules.

- If you use a back-end language, you must use the latest version of it.
- If you use a back-end framework, you must use the latest version of it.
- Always use a package manager to handle project dependencies, such as `Composer`, `npm`, etc. Never hardcode dependecies into your code.
- You must follow coding best practices and design architectures when you're coding. Also, your code needs to be cleaned and must has correct indentations and proper file structure.
- All routes need to be cleaned and SEO friendly.
- Don't change the layout of any given template without asking me. If you have to add or change something on given template in any case, always follow the style of that template.
- If this project requires an admin panel, use the latest release of [Phyxle's Admin Panel](https://github.com/phyxle/admin-panel) template to create it. If you don't know how to implement the code, you can use the code in `legacy` directory.
- Always give permission to the admin for change their password.
- Always use these credentials for the testing admin account.
    - Username: admin
    - Email: admin@test.com
    - Password: 12345678
- Always use soft delete method on database and file system actions, unless I asked to do otherwise.
- Always validate data whenever you are creating forms and implementing APIs.
- Add all project related information to a readme file, such as account credentials, building steps, database migration steps, notes, etc. (See last point of `ATTENTION` section) Don't keep useless readme files in your code, such as framework's default readme file.
- Always use meaningful commit messages.
- I will open issues for updates and changes of the project. You should create a new branch from v1 branch for every issue that I opened and push your changes to that branch. After fixing an issue, create merge request assigning me and I will review your merge request. GitLab will provide you meaningful branch names while creating branch for an issue. If you decide to create these branches on your own, always use meaningful branch names.

## PROJECT REQUIREMENTS

### START PROJECT

You need to clone this repository first.

```
git clone https://gitlab.com/phyxle/tharindu/website-fa-0214.git
```

You can find project files, such as templates, older versions (If there any) and assets in `source` branch.

### PROJECT DESCRIPTION

We have reference site for this project.

[https://www.carauktion.ch](https://www.carauktion.ch)

Our client needs an exact clone of this website. So, you should refer this website closely.

This is a website for a car auction company. You need to create auction system for bidding on cars that listed on the website. Anyone (Must be a company) can create account on the website and put their cars on the auction or place a bid for existing car that put by another user. But first, admin needs to review user details and approve their account before they put cars or place bids. Therefore, you need to create user management system on the admin panel. So, admin can read all of users details and can approve or decline their accounts. Also, every car listing should be approved by the admin, before they goes into the auction as well. There is another thing. Admin can set date and time for the auction. It will be visible on the website. I will explain all requirements in detail later in this document.

There are 2 main components of this website.

1. Website
2. Admin panel

#### WEBSITE STRUCTURE

- /
- /accounts/login
- /accounts/register
- /accounts/logout
- /accounts/forgot-password
- /accounts/profile
- /invoices
- /current-vehicles
- /current-vehicles/{car}/edit
- /current-vehicles/{car}[1]
- /current-vehicles/{car}[2]
- /sold-vehicles
- /sold-vehicles/{car}[3]
- /purchased-vehicles
- /purchased-vehicles/{car}[3]
- /how-it-works/instructions
- /how-it-works/prices
- /how-it-works/terms
- /how-it-works/privacy
- /fastauktion/about
- /fastauktion/jobs
- /fastauktion/imprint
- /cars/sell
- /cars/{car}[3]

**NOTE**

1. This is `update` action. If relevant car is already in an ongoing auction, it should be not updatable.
2. This is `destroy` action. If relevant car is already in an ongoing auction, it should be not deletable.
3. This is `show` action.

#### ADMIN PANEL STRUCTURE

- /admin
- /admin/accounts/login
- /admin/accounts/logout
- /admin/accounts/edit-password[1]
- /admin/accounts/profile
- /admin/memberships
- /admin/memberships[2]
- /admin/memberships/{membership}[3]
- /admin/memberships/{membership}[4]
- /admin/memberships/{membership}[5]
- /admin/users
- /admin/users/{user}[3]
- /admin/users/{user}[6]
- /admin/cars
- /admin/cars/{car}[3]
- /admin/cars/{car}[6]

**NOTE**

1. This is a form action.
2. This is `store` action.
3. This is `show` action.
4. This is `update` action.
5. This is `destroy` action.
6. This is `update` action. If it is user, only status (Whether approved or declied) and membership should be updated. If it is car listing, only status (Whether approved or declied) should be updated.

### MULTIPLE LANGUAGES

This wesite has in multiple languages. All translated content will be given by our client later. You should develop this website multiple languages with in mind. Use Laravel's localization features to build this.

### AUCTION SYSTEM

You should create an auction system for this website. Refer reference site to get the idea. Unfortunatly, auction is not started yet on reference site yet. Once it started, go and refer it.

### MEMBERSHIP SYSTEM

This is a membership system in this website. Admin can add various memberships to the website and assign users to that memberships.

Here are the input fields for memberships `store` action.

- Title (String|255)
- Description (String|500)
- Image (JPEG,JPG,PNG,WEBP|1MB|100x100)

### INVOICE SYSTEM

The invoice system will be bit different. Our clients dosen't need digital invoices. Look reference site for learn about their invoices. The requirement is exactly same. They will give us an blank image of an invoice and you should fill it digitally, using code. Afterward, it should be saved in the disk as a PDF file. So, website users can download or view it via their web browser. You can use something like `Intervention Image` library to build this.

### SEARCH

On reference site, there is a real-time search form. You should implement that into our website. You may need to use something like `AJAX` to build this.

## ADDITIONAL NOTES

You should follow this document till the end of the project. If you have any question, ask me directly via Slack channel for this project.
