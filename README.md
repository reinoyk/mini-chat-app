<div id="top">

<!-- HEADER STYLE: CLASSIC -->
<div align="center">


# MINI-CHAT-APP

<em>Connect Instantly, Communicate Seamlessly, Empower Conversations</em>

<!-- BADGES -->
<img src="https://img.shields.io/github/last-commit/reinoyk/mini-chat-app?style=flat&logo=git&logoColor=white&color=0080ff" alt="last-commit">
<img src="https://img.shields.io/github/languages/top/reinoyk/mini-chat-app?style=flat&color=0080ff" alt="repo-top-language">
<img src="https://img.shields.io/github/languages/count/reinoyk/mini-chat-app?style=flat&color=0080ff" alt="repo-language-count">

<em>Built with the tools and technologies:</em>

<img src="https://img.shields.io/badge/Markdown-000000.svg?style=flat&logo=Markdown&logoColor=white" alt="Markdown">
<img src="https://img.shields.io/badge/PHP-777BB4.svg?style=flat&logo=PHP&logoColor=white" alt="PHP">

</div>
<br>

---

## Table of Contents

- [Overview](#overview)
- [Getting Started](#getting-started)
    - [Prerequisites](#prerequisites)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Testing](#testing)

---

## Overview

Mini Chat App is an open-source framework that enables developers to quickly build real-time messaging platforms with minimal effort. It provides essential features like user management, profile customization, contact handling, and both private and group chat functionalities.

**Why mini-chat-app?**

This project streamlines the development of scalable, real-time communication systems. The core features include:

- 🧩 **🔧 Modular Architecture:** Organized models and partials for easy customization and extension.
- 🎯 **💬 Real-time Messaging:** Supports instant private and group conversations with dynamic message handling.
- 🖥️ **🎨 Customizable UI:** Theme toggling for a personalized user experience.
- 🔑 **🔒 Secure User Management:** Handles authentication, profiles, and contact management seamlessly.
- 📊 **📁 Robust Data Schema:** Well-structured database design for scalable chat data storage.
- 🚀 **⚙️ Easy Integration:** Simplifies backend setup with clear separation of concerns and extensible components.

---

## ✨ Features

- **User Registration & Login**
- **Private Chat**  
  1-on-1 messaging with chat history.
- **Group Chat**  
  Create group chats, add/kick members, group messaging.
- **Contact Management**  
  Add/remove contacts for a personal friend list.
- **User Profile & Customization**
  - Edit name, email, address, username, password
  - Set bio/status (like WA/Telegram)
  - Change theme (light/dark mode)
- **Group Settings**
  - Add/kick members (for group admins)
- **Responsive Minimal UI**
  - Clean dashboard, chat rooms, group settings
  - Dark mode toggle with custom icons
- **Logout**

---

## 📚 Database Schema Overview

- **user:**  
  User information (fullname, email, address, username, password, status)
- **contacts:**  
  User’s personal contacts/friend list
- **parties:**  
  Private chat sessions (initiator, recipient)
- **priv_chat:**  
  Private chat messages
- **groups:**  
  Group info (name, creator, time)
- **group_members:**  
  List of members in each group
- **group_messages:**  
  Group chat messages

---

## Getting Started

### Prerequisites

This project requires the following dependencies:

- **Programming Language:** PHP
- **Database:** MySQL(XAMPP)

### Installation

Build mini-chat-app from the source and install dependencies:

**Clone the repository:**
```
git clone https://github.com/reinoyk/mini-chat-app
```

