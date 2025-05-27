// backend/routes/auth.js (Updated with JWT)

const express = require('express');
const bcrypt = require('bcrypt');
const jwt = require('jsonwebtoken');
const pool = require('../db');
const router = express.Router();
require('dotenv').config();

const JWT_SECRET = process.env.JWT_SECRET || 'your_jwt_secret_key';
const TOKEN_EXPIRY = '1h';

// User Registration
router.post('/register', async (req, res) => {
    const { name,email, password } = req.body;
    try {
        // Password validation
        if (password.length < 8) {
            return res.status(400).json({ message: 'Password must be at least 8 characters long.' });
        }
        if (!/[A-Z]/.test(password) || !/[0-9]/.test(password)) {
            return res.status(400).json({ message: 'Password must contain at least one uppercase letter and one number.' });
        }

        const hashedPassword = await bcrypt.hash(password, 10);
        const result = await pool.query(
            'INSERT INTO users (name, email, password) VALUES ($1, $2, $3) RETURNING  id, name, email',
            [name, email, hashedPassword]
        );

        const user = result.rows[0];
        const token = jwt.sign({ id: user.id, name:user.name,  email: user.email }, JWT_SECRET, { expiresIn: TOKEN_EXPIRY });

        res.status(201).json({ message: 'User registered successfully', token });
    } catch (error) {
        console.error(error);
        if (error.code === '23505') {
            res.status(400).json({ message: 'Email already exists' });
        } else {
            res.status(500).json({ message: 'Server Error' });
        }
    }
});

// User Login
router.post('/login', async (req, res) => {
    const { email, password } = req.body;
    try {
        const result = await pool.query('SELECT * FROM users WHERE email = $1', [email]);
        if (result.rows.length === 0) {
            return res.status(400).json({ message: 'User not found. Please sign up first.' });
        }

        const user = result.rows[0];
        const isValidPassword = await bcrypt.compare(password, user.password);

        if (isValidPassword) {
            const token = jwt.sign({ id: user.id, email: user.email }, JWT_SECRET, { expiresIn: TOKEN_EXPIRY });
            res.status(200).json({ message: 'Login successful', token });
        } else {
            res.status(401).json({ message: 'Incorrect password. Please try again.' });
        }
    } catch (error) {
        console.error(error);
        res.status(500).json({ message: 'Server Error' });
    }
});

module.exports = router;