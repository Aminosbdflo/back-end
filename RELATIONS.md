# Project Relations

This document explains the relationships between models in the Laravel project, listed alphabetically from A to Z.

## Books
- belongsTo Category (category_id)
- belongsTo BookType (book_type_id)
- belongsTo User (user_id)
- hasMany Transaction (book_id)

## BookType
- hasMany Books (book_type_id)

## Category
- hasMany Books (category_id)

## Message
- belongsTo User (sender_id)
- belongsTo User (receiver_id)

## Transaction
- belongsTo User (user_id)
- belongsTo Books (book_id)
- belongsTo User (approved_by)

## User
- hasMany Transaction (user_id)
- hasMany Transaction (approved_by)
