import boto3
import os
import json

# Get the queue. This returns an SQS.Queue instance
creds = {}
with open(os.path.dirname(os.path.realpath(__file__))+"/creds.json") as f:
	creds = json.load(f)

session = boto3.Session(aws_access_key_id=creds['key'], aws_secret_access_key=creds['secret'])
sqs = boto3.resource('sqs')
queue = sqs.get_queue_by_name(QueueName='WriteboardTest')

# Process messages by printing out body
for message in queue.receive_messages():
    print('{0}'.format(message.body))

    # Let the queue know that the message is processed
    message.delete()
