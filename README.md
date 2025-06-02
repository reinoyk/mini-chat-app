# 💬 Mini Chat App (PHP & MySQL)

A minimalistic real-time chat web application built with PHP and MySQL.  
Supports private and group messaging, user customization, and a modern UI.

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

## 🚀 Quick Start

1. **Clone the repository**  
   ```bash
   git clone https://github.com/your-username/mini-chat-app.git
