import discord
from discord.ext import commands
from discord.utils import get
from asyncio import sleep

intents = discord.Intents.default()
intents.reactions = True
intents.messages = True
intents.guilds = True
intents.members = True
intents.message_content = True

bot = commands.Bot(command_prefix='!', intents=intents)

@bot.event
async def on_ready():
    print('Bot is ready')

@bot.event
async def on_raw_reaction_add(payload):
    guild_id = 1123971136611422210
    category_id = 1126053065708023808
    channel_id_1 = 1126053159144542258
    message_id_1 = 1126064507228270692
    channel_id_2 = 1126055550157852752
    message_id_2 = 1126064631476129842
    ticket_emoji = '✅'
    close_emoji = '❌'
    confirm_emoji = '🆗'
    
    guild = bot.get_guild(guild_id)

    if payload.guild_id == guild_id and (payload.channel_id == channel_id_1 or payload.channel_id == channel_id_2) \
            and (payload.message_id == message_id_1 or payload.message_id == message_id_2) \
            and str(payload.emoji) == ticket_emoji:
        category = get(guild.categories, id=category_id)
        ticket_number = len(category.channels) + 1
        ticket_channel_name = f'Ticket - {ticket_number:04}'
        ticket_channel = await category.create_text_channel(ticket_channel_name)
        close_message = await ticket_channel.send('Для закрытия тикета нажмите: ❌')
        await close_message.add_reaction(close_emoji)
        
        overwrites = {
            guild.default_role: discord.PermissionOverwrite(read_messages=False),
            payload.member: discord.PermissionOverwrite(read_messages=True)
        }
        await ticket_channel.edit(overwrites=overwrites)
        print(f"Ticket channel created: {ticket_channel_name}")

    elif payload.guild_id == guild_id and payload.channel_id != channel_id_1 and payload.channel_id != channel_id_2:
        ticket_channel = bot.get_channel(payload.channel_id)
        close_message = await ticket_channel.fetch_message(payload.message_id)
        user = get(guild.members, id=payload.user_id)
        
        if user == bot.user:
            return

        if str(payload.emoji) == close_emoji:
            confirm_message = await ticket_channel.send('Вы уверены что хотите закрыть тикет? Если да то нажмите 🆗')
            await confirm_message.add_reaction(confirm_emoji)
            print(f"Request to confirm channel deletion: {ticket_channel.name}")
        
        elif str(payload.emoji) == confirm_emoji:
            await ticket_channel.send('Тикет будет удален через 5 секунд...')
            await sleep(5)
            await ticket_channel.delete()
            print(f"Channel deleted: {ticket_channel.name}")

bot.run('MTEyNTgwMTY1MTQ1OTA3MjExMA.GXGgbR.HP2hbrx7VhC1ZcmjmYD8OTohPoXPzW_oxjFEdk')