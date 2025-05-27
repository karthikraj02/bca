// backend/routes/properties.js (Property Routes)
const express = require('express');
const router = express.Router();
const pool = require('../db');

// Get all land listings
router.get('/', async (req, res) => {
  try {
    const result = await pool.query('SELECT * FROM properties WHERE type = $1', ['land']);
    res.json(result.rows);
  } catch (error) {
    console.error(error);
    res.status(500).send('Server Error');
  }
});

// Add a new land listing
router.post('/', async (req, res) => {
  const { title, location, price, description } = req.body;
  try {
    const result = await pool.query(
      'INSERT INTO properties (title, location, price, description, type) VALUES ($1, $2, $3, $4, $5) RETURNING *',
      [title, location, price, description, 'land']
    );
    res.status(201).json(result.rows[0]);
  } catch (error) {
    console.error(error);
    res.status(500).send('Server Error');
  }
});

module.exports = router;
