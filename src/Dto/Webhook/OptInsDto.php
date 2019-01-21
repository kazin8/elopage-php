<?php

namespace Kazin8\Elopage\Dto\Webhook;

class OptInsDto extends BaseDto
{
    protected $questionId;
    protected $question;
    protected $answer;

    /**
     * @return mixed
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * @param mixed $questionId
     *
     * @return self
     */
    public function setQuestionId($questionId): self
    {
        $this->questionId = $questionId;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     *
     * @return self
     */
    public function setQuestion($question): self
    {
        $this->question = $question;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     *
     * @return self
     */
    public function setAnswer($answer): self
    {
        $this->answer = $answer;

        return $this;
    }

}