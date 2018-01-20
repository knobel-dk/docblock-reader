import tensorflow as tf
from tensorflow.models.rnn.translate import data_utils
import translation as tr

#
snippet_size = 40000
code_size = 40000

snippet_train, code_train, snippet_test, code_test = data_utils.prepare_wmt_data('data', snippet_size, code_size)

encoder_inputs = []
decoder_inputs = []

self.encoder_inputs.append(tf.placeholder(tf.int32, shape=[None], name="encoder{0}".format(i)))
self.decoder_inputs.append(tf.placeholder(tf.int32, shape=[None], name="decoder{0}".format(i)))

model = seq2seq.embedding_attention_seq2seq(encoder_inputs, decoder_inputs,
    num_layers=1, num_units=256, num_encoder_symbols=snippet_size, num_decoder_symbols=code_size, embedding_size=256)

with tf.Session() as sess:
    model = create_model(sess)