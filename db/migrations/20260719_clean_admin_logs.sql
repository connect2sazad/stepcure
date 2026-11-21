-- Optional one-time cleanup of historical UI noise. Meaningful CRUD logs are preserved.
DELETE FROM `admin_updates`
WHERE `update_text` IN ('User Logged In','User Logged Out')
   OR `update_text` LIKE '%Permission denied%'
   OR `update_text` LIKE '%Invalid permission%';

-- Prevent unlimited growth while retaining approximately one year of audit history.
DELETE FROM `admin_updates`
WHERE `updated_at` < DATE_SUB(NOW(), INTERVAL 365 DAY);
