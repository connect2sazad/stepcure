-- Run once on an existing StepCure database.
-- Supports consultation list filters and newest-first ordering.
ALTER TABLE `consultations`
  ADD INDEX `idx_consultations_list` (`is_deleted`, `is_active`, `site_id`, `created_at`),
  ADD INDEX `idx_consultations_user_list` (`user_id`, `is_deleted`, `is_active`, `created_at`),
  ADD INDEX `idx_consultations_patient` (`patient_id`),
  ADD INDEX `idx_consultations_recommender` (`recomended_by_user_id`);
