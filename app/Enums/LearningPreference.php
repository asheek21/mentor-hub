<?php

namespace App\Enums;

enum LearningPreference: string
{
    case HANDSONPRACTICE = 'hands_on_practice';
    case DISCUSSIONQANDA = 'discussion_q_and_a';
    case CODEREVIEW = 'code_review';
    case STRUCTUREDLEARNING = 'structured_learning';

    public function label()
    {
        return match ($this) {
            self::HANDSONPRACTICE => 'Hands-on Practice',
            self::DISCUSSIONQANDA => 'Discussion Q & A',
            self::CODEREVIEW => 'Code/Work Review',
            self::STRUCTUREDLEARNING => 'Structured Learning',
        };
    }

    public function description()
    {
        return match ($this) {
            self::HANDSONPRACTICE => 'Learn by doing projects and coding together',
            self::DISCUSSIONQANDA => 'Learn through conversation and asking questions',
            self::CODEREVIEW => 'Get feedback on your existing work and projects',
            self::STRUCTUREDLEARNING => 'Follow a curriculum or planned learning path',
        };
    }
}
